<?php

namespace Netzhirsch\SliderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Netzhirsch\SliderBundle\Repository\SliderRepository;

#[ORM\Entity(repositoryClass: SliderRepository::class)]
#[ORM\Table(name: 'tl_nh_slider')]
class Slider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(type: 'integer')]
    private ?int $contentElementId = null;
    #[ORM\Column(length: 255)]
    private ?string $breakpoint = null;
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $adaptiveHeight = false;
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $autoplay = false;
    #[ORM\Column(type: 'integer', options: ['default' => 3000])]
    private ?int $autoplaySpeed = null;
    #[ORM\Column(length: 9, options: ['default' => 'inherited'])]
    private string $arrows = 'inherited';
    #[ORM\Column(length: 255,nullable: true)]
    private ?string $asNavFor = null;
    #[ORM\Column(length: 9, options: ['default' => 'inherited'])]
    private string $centerMode = 'inherited';
    #[ORM\Column(length: 255,nullable: true)]
    private ?string $centerPadding = null;
    #[ORM\Column(length: 9, options: ['default' => 'inherited'])]
    private string $dots = 'inherited';
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $draggable = false;
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $infinite = false;
    #[ORM\Column(length: 255,nullable: true)]
    private ?string $initialSlide = null;
    #[ORM\Column(length: 12, options: ['default' => 'ondemand'])]
    private ?string $lazyLoad = null;
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $pauseOnFocus = false;
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $pauseOnHover = false;
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $pauseOnDotsHover = false;
    #[ORM\Column(type: 'integer', options: ['default' => 1])]
    private ?int $slidesToShow = null;
    #[ORM\Column(type: 'integer', options: ['default' => 1])]
    private ?int $slidesToScroll = null;
    #[ORM\Column(type: 'integer', options: ['default' => 300])]
    private ?int $speed = null;
    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    private bool $swipe = true;
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $swipeToSlide = false;
    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    private bool $touchMove = true;
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $variableWidth = false;
    #[ORM\Column(type: 'integer', options: ['default' => 1000])]
    private ?int $zIndex = null;
    #[ORM\Column(type: 'integer', options: ['default' => 1])]
    private ?int $version = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentElementId(): ?int
    {
        return $this->contentElementId;
    }

    public function setContentElementId(?int $contentElementId): void
    {
        $this->contentElementId = $contentElementId;
    }

    public function getBreakpoint(): ?string
    {
        return $this->breakpoint;
    }

    public function setBreakpoint(?string $breakpoint): void
    {
        $this->breakpoint = $breakpoint;
    }

    public function isAdaptiveHeight(): bool
    {
        return $this->adaptiveHeight;
    }

    public function setAdaptiveHeight(bool $adaptiveHeight): void
    {
        $this->adaptiveHeight = $adaptiveHeight;
    }

    public function isAutoplay(): bool
    {
        return $this->autoplay;
    }

    public function setAutoplay(bool $autoplay): void
    {
        $this->autoplay = $autoplay;
    }

    public function getAutoplaySpeed(): ?int
    {
        return $this->autoplaySpeed;
    }

    public function setAutoplaySpeed(?int $autoplaySpeed): void
    {
        $this->autoplaySpeed = $autoplaySpeed;
    }

    public function getArrows(): string
    {
        return $this->arrows;
    }

    public function setArrows(string $arrows): void
    {
        $this->arrows = $arrows;
    }

    public function getAsNavFor(): ?string
    {
        return $this->asNavFor;
    }

    public function setAsNavFor(?string $asNavFor): void
    {
        $this->asNavFor = $asNavFor;
    }

    public function getCenterMode(): string
    {
        return $this->centerMode;
    }

    public function setCenterMode(string $centerMode): void
    {
        $this->centerMode = $centerMode;
    }

    public function getCenterPadding(): ?string
    {
        return $this->centerPadding;
    }

    public function setCenterPadding(?string $centerPadding): void
    {
        $this->centerPadding = $centerPadding;
    }

    public function getDots(): string
    {
        return $this->dots;
    }

    public function setDots(string $dots): void
    {
        $this->dots = $dots;
    }

    public function isDraggable(): bool
    {
        return $this->draggable;
    }

    public function setDraggable(bool $draggable): void
    {
        $this->draggable = $draggable;
    }

    public function isInfinite(): bool
    {
        return $this->infinite;
    }

    public function setInfinite(bool $infinite): void
    {
        $this->infinite = $infinite;
    }

    public function getInitialSlide(): ?string
    {
        return $this->initialSlide;
    }

    public function setInitialSlide(?string $initialSlide): void
    {
        $this->initialSlide = $initialSlide;
    }

    public function getLazyLoad(): ?string
    {
        return $this->lazyLoad;
    }

    public function setLazyLoad(?string $lazyLoad): void
    {
        $this->lazyLoad = $lazyLoad;
    }

    public function isPauseOnFocus(): bool
    {
        return $this->pauseOnFocus;
    }

    public function setPauseOnFocus(bool $pauseOnFocus): void
    {
        $this->pauseOnFocus = $pauseOnFocus;
    }

    public function isPauseOnHover(): bool
    {
        return $this->pauseOnHover;
    }

    public function setPauseOnHover(bool $pauseOnHover): void
    {
        $this->pauseOnHover = $pauseOnHover;
    }

    public function isPauseOnDotsHover(): bool
    {
        return $this->pauseOnDotsHover;
    }

    public function setPauseOnDotsHover(bool $pauseOnDotsHover): void
    {
        $this->pauseOnDotsHover = $pauseOnDotsHover;
    }

    public function getSlidesToShow(): ?int
    {
        return $this->slidesToShow;
    }

    public function setSlidesToShow(?int $slidesToShow): void
    {
        $this->slidesToShow = $slidesToShow;
    }

    public function getSlidesToScroll(): ?int
    {
        return $this->slidesToScroll;
    }

    public function setSlidesToScroll(?int $slidesToScroll): void
    {
        $this->slidesToScroll = $slidesToScroll;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(?int $speed): void
    {
        $this->speed = $speed;
    }

    public function isSwipe(): bool
    {
        return $this->swipe;
    }

    public function setSwipe(bool $swipe): void
    {
        $this->swipe = $swipe;
    }

    public function isSwipeToSlide(): bool
    {
        return $this->swipeToSlide;
    }

    public function setSwipeToSlide(bool $swipeToSlide): void
    {
        $this->swipeToSlide = $swipeToSlide;
    }

    public function isTouchMove(): bool
    {
        return $this->touchMove;
    }

    public function setTouchMove(bool $touchMove): void
    {
        $this->touchMove = $touchMove;
    }

    public function isVariableWidth(): bool
    {
        return $this->variableWidth;
    }

    public function setVariableWidth(bool $variableWidth): void
    {
        $this->variableWidth = $variableWidth;
    }

    public function getZIndex(): ?int
    {
        return $this->zIndex;
    }

    public function setZIndex(?int $zIndex): void
    {
        $this->zIndex = $zIndex;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(?int $version): void
    {
        $this->version = $version;
    }
}
