
var models = require('./models.json'),
    _ = require('underscore'),
    fs = require('fs'),
    itemHTML = fs.readFileSync('template/item.html').toString(),
    layoutHTML = fs.readFileSync('template/layout.html').toString(),
    itemTemplate = _.template(itemHTML),
    layoutTemplate = _.template(layoutHTML);

var generatedIndexHTML = layoutTemplate({models: models});

fs.writeFile('index.html', generatedIndexHTML);
console.log('Generated site content into index.html');