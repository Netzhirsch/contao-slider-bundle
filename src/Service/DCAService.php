<?php

namespace Netzhirsch\ContaoSliderBundle\Service;

use Contao\ContentModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Netzhirsch\ContaoSliderBundle\Entity\Slider;
use Netzhirsch\ContaoSliderBundle\SliderDatabase;

readonly class DCAService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private readonly  SliderDatabase $sliderDatabase
    )
    {
    }

    public function cloneByContent(
        ServiceEntityRepository $repository,
        int $id,
        int $newId
    ): void
    {
        $entities = $repository->findBy(['contentElementId' => $id]);
        foreach ($entities as $entity) {
            $newEntity = clone $entity;
            $newEntity->setContentElementId($newId);
            $this->sliderDatabase->updateSliderJavaScriptByContent($id,$newId);
            $this->entityManager->persist($newEntity);
        }
        if (empty($entities)) {
            $breakpoints = [
                'xs',
                'sm',
                'md',
                'lg',
                'xl',
                'xxl',
            ];
            foreach ($breakpoints as $breakpoint) {
                $newEntity = new Slider();
                $newEntity->setBreakpoint($breakpoint);;
                $newEntity->setContentElementId($newId);
                if ($newEntity->getBreakpoint() == 'xs') {
                    $this->sliderDatabase->updateSliderJavaScriptByContent($newId);
                }
                $this->entityManager->persist($newEntity);
            }
        }
        $this->entityManager->flush();
    }

    public function cloneByArticle(
        string $type,
        int $id,
        int $newId,
        ServiceEntityRepository $repository,
    )
    {
        $this->cloneImageOnContent($type,$id,$newId,$repository);
    }

    private function cloneImageOnContent(
        string $type,
        int $id,
        int $newId,
        ServiceEntityRepository $repository,
    ): void {
        $cloneContents = ContentModel::findBy(['pid=?', 'type="'.$type.'"'],$id,['order' => 'sorting ASC'])??[];
        $ids = [];
        foreach ($cloneContents as $content) {
            $ids[] = $content->id;
        }
        if (empty($ids)) {
            return;
        }

        $newContents = ContentModel::findBy(['pid=?', 'type="'.$type.'"'], $newId,['order' => 'sorting ASC'])??[];

        $entities = $repository->findBy(['contentElementId' => $ids])??[];

        if (!empty($entities)) {
            foreach ($entities as $entity) {
                foreach ($ids as $key => $contentElementId) {
                    $newContent = $newContents->offsetGet($key);
                    if (empty($newContent) || $contentElementId != $entity->getContentElementId()) {
                        continue;
                    }
                    $newEntity = clone $entity;
                    $newEntity->setContentElementId($newContent->id);
                    $this->entityManager->persist($newEntity);
                    $this->entityManager->flush();
                    if ($newEntity->getBreakpoint() == 'xs') {
                        $this->sliderDatabase->updateSliderJavaScriptByContent($newContent->id);
                    }
                }
            }
        }
    }

    public function deleteByContent(
        ServiceEntityRepository $repository,
        int $id
    )
    {
        $entity = $repository->findOneBy(['contentElementId' => $id]);
        if (!empty($entity)) {
            $this->entityManager->remove($entity);
        }
    }

    public function deleteByArticle(
        string $type,
        int $id,
        ServiceEntityRepository $repository
    ): void {

        $this->deleteEntityFromContent($type, $id, $repository);
    }

    private function deleteEntityFromContent(
        string $type,
        int $id,
        ServiceEntityRepository $repository
    ): void {
        $contents = ContentModel::findBy(['pid=?', 'type="'.$type.'"'],$id,['order' => 'sorting ASC'])??[];
        foreach ($contents as $content) {
            $ids[] = $content->id;
        }
        if (empty($ids)) {
            return;
        }

        $entities = $repository->findBy(['contentElementId' => $ids]);

        if (!empty($entities)) {
            foreach ($entities as $entity) {
                $this->entityManager->remove($entity);
            }
        }
    }
}