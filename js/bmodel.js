var left_container = $('.left-container');

var slider =$('#create_task_panel').slideReveal({
    push: false,
    overlay: true,
    position:"right",
    width:"30%"
});

var Model = {};
var TaskList = {};
var Id = '';

// https://nnattawat.github.io/slideReveal/
$(function(){
    RestGet();
});

function RestGet(){
    left_container.html('').append('<div class="left-container-items">'+
        '<div class="panel panel-default">'+
        '<div class="panel-body" align="center">'+
        '<a href="#" id="create_task_button" class="link_new_task" onclick="CreateTrigger()">+ NEW TASK</a>'+
        '</div>'+
        '</div>'+
        '</div>');

    $.ajax({
        url: 'http://localhost:3333/tasklist',
        type: 'GET',
        dataType: "json",
    })

        .done(function( data ) {

            TaskList = data;
            data.forEach(function(currentValue, index, array){
                left_container.append('<div class="left-container-items">\n' +
                    '<div class="panel panel-default">\n' +
                    '<div class="panel-body">\n' +
                    '<p>'+currentValue['TaskText'] +'</p>'+
                    '<p><button type="button" class="btn btn-primary btn-sm" onclick="EditTrigger(\''+currentValue['id'] +'\', \''+index+'\')">EDIT</button>'+
                    '&nbsp;<a href="#" onclick="RestDELETE(\''+currentValue['id'] +'\')">DELETE</a></p>'+
                    '</div>\n' +
                    '</div>\n' +
                    '</div>');
            });
        });
}

function RestPOST()
{
    $.ajax({
        method: "POST",
        url: "http://localhost:3333/taskstore",
        cache: false,
        data: Model
    })
        .done(function( html ) {
            RestGet();
            slider.slideReveal('toggle');
        });
}

function RestDELETE( id ){
    $.ajax({
        method: "DELETE",
        url: "http://localhost:3333/taskdelete",
        cache: false,
        data: {id : id}
    })
        .done(function( html ) {
            RestGet();
        });
}

function CreateTrigger(){
    Id = '';
    $('#save_oper').text('Create Task');
    slider.slideReveal('toggle');
    renderCategory(0);
    renderSubCategory(0, 0);
    $('#task-description').val('');
    AssemblyTaskText();
}

function EditTrigger( id , ind ) {
    Id = id;
    $('#save_oper').text('Edit Task');
    slider.slideReveal('toggle');
    renderCategory(TaskList[ind]['Category']);
    renderSubCategory(TaskList[ind]['Category'], TaskList[ind]['SubCategory']);
    $('#task-description').val(TaskList[ind]['Description']);
    AssemblyTaskText();
}


var options = {
    "Electrician":[
        "Eemergency electrician",
        "Lighting",
        "Switchboard upgrade",
        "Alarm systems",
        "Electrical testing",
        "Longreach service agents"
    ],
    "Plumber":[
        "Unblock a toilet",
        "Unblock a sink",
        "Fix a water leak",
        "Install a sink",
        "Install a shower",
        "Install a toilet"
    ],
    "Gardener":[
        "Landscaper",
        "Cemetery worker",
        "Fence installer",
        "Florist",
        "Groundsperson"
    ],
    "Housekeeper":[
        "Dishwashing",
        "Trash disposal",
        "Windexing",
        "Baseboards",
        "Bed makings",
        "Dusting"
    ],
    "Cook":[
        "Food Safety",
        "Kitchen Management",
        "Gastronomy",
        "Nutrition",
        "Culinary Math",
        "Product Knowledge"
    ]
};

var category = $('#category');
var subcategory = $('#subcategory');

function renderCategory(id)
{

    var categoryList = Object.getOwnPropertyNames(options);
    var categoryHtml = '';
    categoryList.forEach(function(item) {
        categoryHtml+='<label>' +
            '<input type="radio" name="service_type" value="'+item+'" id="'+categoryList.indexOf(item)+'" '+(categoryList.indexOf(item) === id?'checked':'')+'/>'+
            '<img src="img/'+item+'.png" class="icons" onclick="renderSubCategory('+categoryList.indexOf(item)+', 0)">'+
            '<p class="icon-text">'+item+'</p>'+
            '</label>';
    });
    category.html(categoryHtml);
}

function renderSubCategory(id1, id2)
{
    var id1_name = '';
    var categoryList = Object.getOwnPropertyNames(options);
    categoryList.forEach(function(item) {
        //console.log(categoryList.indexOf(item), id1, item);
        if(categoryList.indexOf(item) === id1){
            id1_name = item;
        }
    });

    var subcategoryHtml = '';
    if(options[id1_name] !== undefined){
        $.each(options[id1_name], function(index, value) {
            subcategoryHtml+='<label>' +
                '<input type="radio" name="sub_service" id="'+index+'" value="'+value+'" '+(index === id2?'checked':'')+'/>'+
                '<p class="icon-text texts">'+value+'</p>'+
                '</label>';
        });
    }
    subcategory.html(subcategoryHtml);
    refreshListiner();
}

function AssemblyTaskText( id )
{
    let Category = '';
    let CategoryID = 0;
    let SubCategory = '';
    let SubCategoryID = 0;
    let Description = '';

    let TaskText = '';
    let TaskAddress = '';

    $('input[type=radio]:checked').each(function (index) {
        if($(this).attr('name') === 'service_type'){
            Category = $(this).attr('value');
            CategoryID = $(this).attr('id');
        }
        else if($(this).attr('name') === 'sub_service'){
            SubCategory = $(this).attr('value');
            SubCategoryID = $(this).attr('id');
        }
    });

    Description = $('#task-description').val();
    TaskAddress = $('#task-location').text();

    TaskText =
        (Category!==''?'I need ':'') + '<b>'+ Category + '</b>'+
        (SubCategory!==''?' to ':'') + '<b>' + SubCategory + '</b>'+
        (Description!==''?', ':'') + '<b>' + Description + '</b><br>'+
        '<p class="preview-location">My address is '+ TaskAddress + '</p>';

    $('#preview-text').html(TaskText);

    fillModel(
        {
            id: Id,
            TaskText: TaskText,
            TaskAddress: TaskAddress,
            Category: CategoryID,
            SubCategory: SubCategoryID,
            Description: Description
        }
    );

}

function fillModel( Obj ){
    Model = Obj;
    return Model;
}

function refreshListiner(){
    $('input[type=radio], textarea[id=task-description]')
        .on('click', function () {
            AssemblyTaskText();
        })
        .on('blur', function () {
            AssemblyTaskText();
        })
        .on('keyup', function () {
            AssemblyTaskText();
        })
}
