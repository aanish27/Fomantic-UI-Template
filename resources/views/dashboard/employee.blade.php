<x-app-layout>
    <table id="myTable" class="ui very compact striped table" width="100%"></table>

    <div class="ui tiny top aligned modal ">
        <div class="header">Delete Employee Record</div>
        <div class="content">
            <p></p>
        </div>
        <div class="actions">
            <div class="ui cancel button">Cancel</div>
            <div class="ui  button">Delete</div>
        </div>
    </div>


    <div class="ui modal" id="form_modal">
        <div class="header modal_title">ADD NEW EMPLOYEE</div>
        <div class="content">
            <form class="ui form crud_form">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <label for="name" >Name</label>
                        <input id="name" type="text" placeholder="Name" name="name">
                    </div>
                    <div class="field">
                        <label for="position">Postion</label>
                        <select id="position" name="position" class="ui search dropdown">
                            <option value="">Select Position</option>
                            <option value="Intern_Software_Engineer">Intern Software Engineer</option>
                            <option value="Associate_Software_Engineer">Associate Software Engineer</option>
                            <option value="Software_Engineer">Software Engineer</option>
                            <option value="Senior_Software_Engineer">Senior Software Engineer</option>
                            <option value="Tech_Lead">Tech Lead</option>
                            <option value="Project_Manager">Project Manager</option>
                            <option value="QA_Engineer">QA Engineer</option>
                        </select>
                    </div>
                </div>
                <div class="three fields">
                    <div class="field">
                        <label for="dob" >DOB: </label>
                        <input id="dob" type="date" placeholder="DOB" name="dob" class="ui inverted">
                    </div>
                    <div class="field ui inverted">
                        <label for="email">Email</label>
                        <input id="email" type="email" placeholder="email" name="email" required>
                    </div>
                    <div class="field">
                        <label for="phone">Phone</label>
                        <input id="phone" type="text" placeholder="Phone" name="phone" class="ui inverted">
                    </div>
                </div>
                <div class="field">
                    <label for="address" >Address</label>
                    <input id="address" type="text" placeholder="address" name="address">
                </div>
                  <div class="ui primary submit button" style="display: none;">Submit</div>
                  <div class="ui error message"></div>
            </form>
        </div>
        <div class="right actions">
            <div class="ui negative red button">Cancel</div>
            <div class="ui green button" id="btn_main_submit">Submit</div>
        </div>
    </div>

    <script type="module">
        $(document).ready(function () {
            $('.tiny.modal') .modal({
                dimmerSettings: { opacity: 0 },
                closable: false
            }
            )

            let table = $('#myTable').DataTable({
            scrollCollapse: true,
            scrollX: true,
            responsive: true,
            layout: {
                topStart: null,
                topEnd: null,
                top1Start:{

                },
                    top0Start:{
                    pageLength: {
                    placeholder: 'Filter'
                    },
                    search: {
                        placeholder: 'Type search here'
                    },
                },
                top0End:{
                    buttons: [{
                        text: '<i class="plus icon"></i> New',
                        attr: {
                            id: 'btn_add_record',
                            class: 'ui button primary' ,
                        },
                        action: function (e, dt, node, config, cb) {
                            // storeEmployee()
                        }
                    }]
                }
            },
            language: {
                lengthMenu:  '_MENU_',
                search: ' '
            },
            scrollY: 690,
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                url: 'employee/draw',
            },
            columns: [
                {
                    data: 'id',
                    title:'#' ,
                    name: 'id',
                },
                {
                    data: null ,
                    title: "Actions",
                    render: function (data, type, row) {
                        return `<button id="btn_edit" class="ui icon button" style="padding: 0; background:transparent;">
                                    <i class="edit outline small bordered colored icon green"></i>
                                </button>

                                <button id="btn_delete" class="ui icon button" style="padding: 0; background:transparent;">
                                    <i class="trash alternate outline small bordered colored icon red"></i>
                                </button>
                                `
                    },
                    name: 'action',
                    orderable: false,
                    sortable: false,
                },
                {
                    data: 'name' ,
                    title: 'Name' ,
                    name: 'name',
                },
                {
                    data: 'position' ,
                    title:'Position' ,
                    name: 'position',
                },
                {
                    data: 'dob',
                    title:'DOB' ,
                    name: 'dob',
                },
                {
                    data: 'email' ,
                    title:'Email' ,
                    name: 'email',
                },
                {
                    data: 'phone',
                    title:'Phone' ,
                    name: 'phone'
                },
                {
                    data: 'address' ,
                    title:'Address' ,
                    name: 'address',
                },
            ],
        });

        $('#myTable').on('draw.dt', function () {
            if (localStorage.getItem('theme') == 'dark') {
                $('.ui.unstackable.pagination.menu').addClass('inverted');
            }
        });

        $('#btn_main_submit').on('click', function (e) {
            e.preventDefault()
            $('.crud_form').submit()
        });

        //CREATE
        $('#btn_add_record').on('click', function () {
            $('#form_modal').modal('show');
            $('.crud_form').attr("id","create_form").trigger("reset");
            $('.modal_title').text("ADD EMPLOYEE DETAILS");
            $('#btn_main_submit').text("Submit");
        });

        $('.ui.modal').on('submit' , '#create_form', function (e){
            e.preventDefault();
            let $data = $('#create_form').serialize()
            axios.post('employees', $data )
            .then(function (response){
                displayToast(response , "success")
                $('#form_modal').modal('hide');
                $('#create_form').trigger("reset");
                table.draw(false);
            })
            .catch(function (response){
                displayToast(response , "error")
            });
        });

        // UPDATE
        let id = null
        $('#myTable tbody').on('click', '#btn_edit', function (e) {
            $('.modal_title').text("Edit Employee Details");
            $('#btn_main_submit').text("Update");
            $('#form_modal').modal('show');
            $('.crud_form').attr("id","update_form");

            id = table.row( $(this).parents('tr') ).data().id;

            axios.get(`employees/${id}/edit`)
            .then(function (response){
                const data = response.data[0];
                $('#name').val(data.name)
                $('#position').val(data.position)
                $('#dob').val(data.dob)
                $('#email').val(data.email)
                $('#phone').val(data.phone)
                $('#address').val(data.address)
            });
        });

        $('.ui.modal').on('submit' , '#update_form', function (e){
            e.preventDefault();
            let dataSubmit = new FormData(this)
            dataSubmit.append('_method', 'patch');

            axios.post(`employees/${id}`, dataSubmit )
            .then(function (response){
                displayToast(response , "success")
                $('#form_modal').modal('hide');
                $('.create_form').trigger("reset");
                table.draw(false);
            })
            .catch(function (response){
                displayToast(response , "error")
            });
        });

        function displayToast(response , type){
            if (type == "error") {
                const errors = response.response.data
                for (const field in errors) {
                    errors[field].forEach((error) => {
                        $.toast({
                            class: 'error',
                            message: error,
                        });
                    });
                }
            } else {
                $.toast({
                    class: 'success',
                    message: response.data,
                });
            }
        }

        $('.ui.negative.red.button').on('click', function () {
            $('.ui.form').form('reset')
        });

        $('.ui.form').form({
            fields: {
                name: {
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }
                    ]
                },
                position: {
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please select a position'
                        }
                    ]
                },
                DOB: {
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your date of birth'
                        }
                    ]
                },
                email: {
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your email'
                        },
                        {
                            type: 'email',
                            prompt: 'Please enter a valid email address'
                        }
                    ]
                },
                phone: {
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your phone number'
                        },
                    ]
                },
                address: {
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your address'
                        }
                    ]
                }
            },
            inline : true,
        });
    });
    </script>
</x-app-layout>
