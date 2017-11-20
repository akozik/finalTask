'use strict';

let express = require('express');
let bodyParser = require('body-parser');

let app = express();

function genid()
{
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    var string_length = 15;
    var randomstring = '';
    for (var i=0; i<string_length; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars.substring(rnum,rnum+1);
    }
    return randomstring;
}


app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended:true}));

let dbase = [
    {
        id: genid(),
        TaskText: 'I need <b>Plumber</b> to <b>Fix a water leak</b>, <b>for life</b><br><p class="preview-location">My address is 141 Ogunlana Dr, Lagos 10128</p>',
        TaskAddress: 'My address is 141 Ogunlana Dr, Lagos 10128',
        Category: 1,
        SubCategory: 2,
        Description: 'for life'
    },
    {
        id: genid(),
        TaskText: 'I need <b>Gardener</b> to <b>Cemetery worker</b>, <b>for hell</b><br><p class="preview-location">My address is 141 Ogunlana Dr, Lagos 10128</p>',
        TaskAddress: 'My address is 141 Ogunlana Dr, Lagos 10128',
        Category: 2,
        SubCategory: 1,
        Description: 'for hell'
    },
];

app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Methods", "GET, POST, OPTIONS, PUT, DELETE");
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");

    next();
});

// Выборка всего списка задач
app.get('/tasklist', (req, res) => res.send(dbase));

// Универсальный контроллер для сохранения / редактирования задачи
app.post('/taskstore', (req, res) => {

    let model = dbase.find(dbase => dbase.id === req.body.id);

    if(!model) {

        model = {
            id: genid(),
            TaskText: req.body.TaskText,
            TaskAddress: req.body.TaskAddress,
            Category: parseInt(req.body.Category),
            SubCategory: parseInt(req.body.SubCategory),
            Description: req.body.Description
        };

        dbase.push( model );
    }
    else {

        model.TaskText = req.body.TaskText;
        model.TaskAddress = req.body.TaskAddress;
        model.Category = parseInt(req.body.Category);
        model.SubCategory = parseInt(req.body.SubCategory);
        model.Description = req.body.Description;

    }

    res.send(model);
    //res.sendStatus(200);
});

// Удаление записи
app.delete('/taskdelete', (req, res) => {
    dbase = dbase.filter(function( obj ){
        return !(obj.id === req.body.id);
    });
    res.sendStatus(200);
});



app.listen(3333, () => console.log('API STARTED'));
