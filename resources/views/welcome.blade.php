<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exam Crud</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <style>
    html,
    body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;

        justify-content: center;
        margin-left: 20%;
        margin-right: 20%;
    }

    .position-ref {
        position: relative;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
    </style>

</head>

<body>

    <div id="app">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Add Exam Questions
                </div>
                <div class="alert alert-danger" role="alert" v-bind:class="{hidden: hasError}">
                    All fields are required!
                </div>
                <div class="form-group">
                    <label for="question">Exam Question</label>
                    <input type="text" class="form-control" id="question" required placeholder="Exam Question"
                        name="question" v-model="newExam.question">
                </div>

                <div class="form-group">
                    <label for="option1">Option 1</label>
                    <input type="text" class="form-control" id="option1" required placeholder="Option 1" name="option1"
                        v-model="newExam.option1">
                </div>

                <div class="form-group">
                    <label for="option2">Option 2</label>
                    <input type="text" class="form-control" id="option2" required placeholder="Option 2" name="option2"
                        v-model="newExam.option2">
                </div>

                <div class="form-group">
                    <label for="option3">Option 3</label>
                    <input type="text" class="form-control" id="option3" required placeholder="Option 3" name="option3"
                        v-model="newExam.option3">
                </div>
                <div class="form-group">
                    <label for="option4">Option 4</label>
                    <input type="text" class="form-control" id="option4" required placeholder="Option 4" name="option4"
                        v-model="newExam.option4">
                </div>
                <div class="form-group">
                    <label for="category">Option 4</label>
                    <!-- <input type="text" class="form-control" id="category" required placeholder="Category" name="option" v-model="newExam.category"> -->
                    <select class="form-control" id="category" required name="option" v-model="newExam.category">
                        <option value=technical">Technical</option>
                        <option value="aptitude">Aptitude</option>
                        <option value=logical">Logical</option>
                    </select>
                </div>
                <button class="btn btn-primary" @click.prevent="createExam()">
                    Add Exam Question
                </button>

                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Option 1</th>
                            <th scope="col">Option 2</th>
                            <th scope="col">Option 3</th>
                            <th scope="col">Option 4</th>
                            <th scope="col">Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="exam in exams">
                            <th scope="row">@{{exam.id}}</th>
                            <td>@{{exam.question}}</td>
                            <td>@{{exam.option1}}</td>
                            <td>@{{exam.option2}}</td>
                            <td>@{{exam.option3}}</td>
                            <td>@{{exam.option4}}</td>
                            <td>@{{exam.category}}</td>

                            <td @click="setVal(exam.id, exam.question, exam.option1, exam.option2, exam.option3, exam.option4, exam.category)"
                                class="btn btn-info" class="btn btn-info btn-lg" data-toggle="modal"
                                data-target="#myModal"><i class="fa fa-pencil"></i>
                            </td>
                            <td @click.prevent="deleteExam(exam)" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-body">
                        <input type="hidden" disabled class="form-control" id="e_id" name="id" required
                            :value="this.e_id">
                        Exam Question: <input type="text" class="form-control" id="e_question" name="question" required
                            :value="this.e_question">
                        Option 1: <input type="text" class="form-control" id="e_option1" name="option" required
                            :value="this.e_option1">
                        Option 2: <input type="text" class="form-control" id="e_option2" name="option" required
                            :value="this.e_option2">
                        Option 3: <input type="text" class="form-control" id="e_option3" name="option" required
                            :value="this.e_option3">
                        Option 4: <input type="text" class="form-control" id="e_option4" name="option" required
                            :value="this.e_option4">
                        Category: <select class="form-control" id="e_category" name="option" required
                            :value="this.e_category">
                            <option value=technical">Technical</option>
                            <option value="aptitude">Aptitude</option>
                            <option value=logical">Logical</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="editExam()">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/js/app.js"></script>
</body>

</html>