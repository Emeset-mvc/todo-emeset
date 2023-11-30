import 'flowbite';
import $ from 'jquery';

$(function () {

    let tasks = $("#tasks");
    if (tasks.length > 0) {
        loadTasks();

        $("#task-add").on("submit", function (e) {
            console.log("hola");
            e.preventDefault();
            addTask();
        });   
    }
});

function addTask() {
    $.post('/tasks', {
        task: $("#task").val()
    }, function (data) {
        loadTasks();
        // console.log("ajax")
        // console.log(data);
        //  let template = $("#task-template");
        //  template.find('.task-text').html(data.task.task);
        //  template.find('.task-link').attr('href', '/tasks/' + data.task.id);
        //  $("#tasks").append(template.html());
    });

}

function deleteTask(id) {
    console.log(id);
    $.get("/tasks/" + id, function (data) {
        console.log(data);
        loadTasks();
    });

}

function loadTasks() {

    $.get('/tasks', function (data) {
        console.log(data);
        let template = $("#task-template");
        $("#tasks").html('');
        for(var i = 0; i < data.todo.length; i++) {
            template.find('.task-text').html(data.todo[i].task);
            template.find('.task-link')
                    .attr('href', '/tasks/' + data.todo[i].id);
            //$("#tasks").append();
            let newTask = template.clone();
            newTask.find("a.task-link").data("id", data.todo[i].id);
            newTask.find("li").appendTo("#tasks");
            console.log(data.todo[i].task);
            //console.log(template.find("a").data());
            
        }
        $("a.task-link").on("click", function (e) {
            e.preventDefault();
            console.log("hola");
            let id = $(e.target).data("id");

            console.log(e.target);
            console.log(id);
            deleteTask(id);
        });

    });

}