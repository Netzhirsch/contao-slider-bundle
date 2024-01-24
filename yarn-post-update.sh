#!/bin/bash
npm install slick-carousel
mkdir -p public/libraries/slick-carousel/slick
cp -r node_modules/slick-carousel/slick public/libraries/slick-carousel
rm -rf node_modules