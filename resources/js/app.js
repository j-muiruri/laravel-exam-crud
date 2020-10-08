/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        newExam: {
            'question': '',
            'option1': '',
            'option2': '',
            'option3': '',
            'option4': '',
            'category': ''
        },
        hasError: true,
        exams: [],
        e_id: '',
        e_question: '',
        e_option1: '',
        e_option2: '',
        e_option3: '',
        e_option4: '',
        e_category: '',
    },


    mounted: function mounted() {
        this.getExams();
    },

    methods: {
        //  Create exams
        createExam: function createExam() {
            var input = this.newExam;
            var _this = this;
            if (input['question'] == '' || input['option1'] == '' || input['option1'] == '' || input['option2'] == '' || input['option3'] == '' || input['option4'] == '' || input['category'] == '') {
                this.hasError = false;
            } else {
                this.hasError = true;
                axios.post('/create', input).then(function (response) {
                    _this.newExam = {
                        'question': '',
                        'option1': '',
                        'option2': '',
                        'option3': '',
                        'option4': '',
                        'category': ''
                    }
                    _this.getExams();
                }).catch(error => {
                    console.log("Insert: " + error);
                });
            }
        },
        // Get Exams
        getExams: function getExams() {
            var _this = this;
            axios.get('/get').then(function (response) {
                _this.exams = response.data;
            }).catch(error => {
                console.log("Get All: " + error);
            });
        },

        setVal(val_id, val_question, val_option1, val_option2, val_option3, val_option4, val_category) {
            this.e_id = val_id;
            this.e_question = val_question;
            this.e_option1 = val_option1;
            this.e_option2 = val_option2;
            this.e_option3 = val_option3;
            this.e_option4 = val_option4;
            this.e_category = val_category;
        },
        //   Edit Exam Question
        editExam: function () {
            var _this = this;
            var id_val_1 = document.getElementById('e_id');
            var question_val_1 = document.getElementById('e_question');
            var option1_val_1 = document.getElementById('e_option1');
            var option2_val_1 = document.getElementById('e_option2');
            var option3_val_1 = document.getElementById('e_option2');
            var option4_val_1 = document.getElementById('e_option4');
            var category_val_1 = document.getElementById('e_category');
            var model = document.getElementById('myModal').value;
            axios.post('/update/' + id_val_1.value, {
                    val_1: question_val_1.value,
                    val_2: option1_val_1.value,
                    val_3: option2_val_1.value,
                    val_4: option3_val_1.value,
                    val_5: option4_val_1.value,
                    val_6: category_val_1.value
                })
                .then(response => {
                    _this.getExams();
                });
        },
        //Delate Exam Question
        deleteExam: function deleteExam(exam) {
            var _this = this;
            axios.post('/delete/' + exam.id).then(function (response) {
                _this.getExams();
            }).catch(error => {
                console.log("Delete exam question: " + error);
            });
        },
    }
});
