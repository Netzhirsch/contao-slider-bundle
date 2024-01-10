#!/bin/bash
npm install slick-carousel
mkdir -p src/Resources/public/libraries/jquery
mkdir -p src/Resources/public/libraries/slick-carousel/slick
cp node_modules/jquery/dist/jquery.min.js src/Resources/public/libraries/jquery
cp -r node_modules/slick-carousel/slick src/Resources/public/libraries/slick-carousel
rm -rf node_modules