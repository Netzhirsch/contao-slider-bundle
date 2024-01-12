#!/bin/bash
npm install slick-carousel
mkdir -p src/Resources/public/libraries/slick-carousel/slick
cp -r node_modules/slick-carousel/slick src/Resources/public/libraries/slick-carousel
rm -rf node_modules