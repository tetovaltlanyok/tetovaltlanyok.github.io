var models = require('./models.json'),
    _ = require('underscore'),
    fs = require('fs'),
    layoutHTML = fs.readFileSync('template/layout.html').toString(),
    layoutTemplate = _.template(layoutHTML);

var generatedIndexHTML = layoutTemplate({models: models});

fs.writeFile('index.html', generatedIndexHTML);
console.log('Generated site content into index.html');