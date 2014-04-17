#!/bin/sh
set -ev

composer install

version=${VERSION:-latest}

[ -d tmp ] && rm -fr tmp
git clone -b gh-pages git@github.com:${GITHUB_USER}/filter tmp
./vendor/bin/phpdoc.php --directory src --target tmp/$version/docs --template responsive-twig --defaultpackagename Chadicus --title "Filters"

cd tmp
git add .
git commit -m "Build phpdocs"
git push origin gh-pages:gh-pages

cd ..
rm -fr tmp
