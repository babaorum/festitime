var protagonist = require('protagonist');
fs = require('fs')
fs.readFile('test.md', 'utf8', function (err,data) {
  if (err) {
    return console.log(err);
  }
    protagonist.parse(data, function(error, result) {
        if (error) {
            console.log(error);
            return;
        }

        console.log(result.ast);
    });
});
