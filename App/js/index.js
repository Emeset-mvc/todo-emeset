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

        $('#task').on("keypress", function (e) {
            if (e.which == 13) {
                $('#task-add').trigger("submit");
            }
        }).trigger("focus");

        $("#tasks").on("click", "a.task-link", function (e) {
            e.preventDefault();
            console.log("hola");
            let id = $(e.target).data("id");

            console.log(e.target);
            console.log(id);
            deleteTask(id);
        });

        $("#finished-tasks").on("click", "a.task-link", function (e) {
            e.preventDefault();
            console.log("hola");
            let id = $(e.target).data("id");

            console.log(e.target);
            console.log(id);
            unDeleteTask(id);
        });
    }
});

function addTask() {
    $.post('/tasks', {
        task: $("#task").val()
    }, function (data) {
        loadTasks();
        $("#task").val('');
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

function unDeleteTask(id) {
    console.log(id);
    $.get("/tasks/" + id + "/undo", function (data) {
        console.log(data);
        loadTasks();
    });

}

function loadTasks() {

    $.get('/tasks', function (data) {
        console.log(data);
        let template = $("#task-template");
        $("#tasks").html('');
        for (var i = 0; i < data.todo.length; i++) {
            template.find('.task-text').html(data.todo[i].task);
            template.find('.task-link')
                .attr('href', '/tasks/' + data.todo[i].id);

            let newTask = template.clone();
            newTask.find("a.task-link").data("id", data.todo[i].id);
            newTask.find("li").appendTo("#tasks");
            console.log(data.todo[i].task);
        }

        $("#finished-tasks").html('');
        for (var i = 0; i < data.done.length; i++) {
            template.find('.task-text').html(data.done[i].task);
            template.find('.task-link')
                .attr('href', '/tasks/' + data.done[i].id + "/undo");

            let newTask = template.clone();
            newTask.find("a.task-link").html("Recupera!").data("id", data.done[i].id);
            newTask.find("li").appendTo("#finished-tasks");
            console.log(data.done[i].task);
        }


    });

}