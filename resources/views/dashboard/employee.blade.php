<x-app-layout>
    <table id="myTable" class="ui very compact striped table" width="100%"></table>

    <div class="ui modal" id="form_modal">
        <div class="header">ADD NEW EMPLOYEE</div>
        <div class="content">
            <form class="ui form">
                <div class="two fields">
                    <div class="field">
                        <label for="name" >Name</label>
                        <input type="text" placeholder="Name" name="name">
                    </div>
                    <div class="field">
                        <label for="postion">Postion</label>
                        <select class="ui search dropdown">
                            <option value="">Select Country</option>
                            <option value="">Intern Software Engineer</option>
                            <option value="">Associate Software Engineer</option>
                            <option value="">Software Engineer</option>
                            <option value="">Senior Software Engineer</option>
                            <option value="">Tech Lead</option>
                            <option value="">Project Manager</option>
                            <option value="">QA Engineer</option>
                        </select>
                    </div>
                </div>
                <div class="three fields">
                    <div class="field">
                        <label for="DOB" >DOB: </label>
                        <input type="date" placeholder="DOB" name="DOB" class="ui inverted">
                    </div>
                    <div class="field ui inverted">
                        <label for="email">Email</label>
                        <input type="email" placeholder="email" name="email" required>
                    </div>
                    <div class="field">
                        <label for="phone">Phone</label>
                        <input type="text" placeholder="Phone" name="phone" class="ui inverted">
                    </div>
                </div>
                <div class="field">
                    <label for="address" >Address</label>
                    <input type="text" placeholder="address" name="address">
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


{{--
 <form class="form-modal row  p-1  needs-validation"  novalidate>
                        @csrf
                        <div class="mb-2 col-3">
                            <label for="name" class="form-label fw-bold ">Name:</label>
                            <input type="text" class="form-control py-1 " id="name" name="name" placeholder="Full Name" required>
                            <div class="invalid-feedback">Please Enter the Name</div>
                            <div class="valid-feedback">Name Valid</div>
                        </div>
                        <div class=" mb-2 col-3">
                            <label class="form-label fw-bold" for="position">Position:</label>
                            <input type="text" class=" form-control py-1 " id="position" name="position" placeholder="Position" required>
                            <div class="invalid-feedback">Please Enter the Position</div>
                            <div class="valid-feedback">Position Valid</div>
                        </div>
                        <div class="mb-2 col-3" >
                            <label class="form-label fw-bold" for="dob">DOB:</label>
                            <input type="date" class=" form-control py-1 " id="dob" name="dob" placeholder="DOB" required>
                            <div class="invalid-feedback">Please Enter the DOB</div>
                            <div class="valid-feedback">DOB Valid</div>
                        </div>
                        <div class=" mb-2 col-3">
                            <label class="form-label fw-bold" for="email">Email:</label>
                            <input type="email" class=" form-control py-1 " id="email" name="email" placeholder="Email" required>
                            <div class="invalid-feedback">Please Enter the Email</div>
                            <div class="valid-feedback">Email Valid</div>
                        </div>
                        <div class=" mb-2 col-3">
                            <label class="form-label fw-bold" for="phone">Phone:</label>
                            <input type="phone" class=" form-control py-1 " id="phone" name="phone" placeholder="Phone" required>
                            <div class="invalid-feedback">Please Enter the Phone Number</div>
                            <div class="valid-feedback">Phone Number Valid</div>
                        </div>
                        <div class="col-9">
                            <label class="form-label fw-bold" for="address">Address:</label>
                            <input type="text" class=" form-control py-1 " id="address" name="address" placeholder="Address" required>
                            <div class="invalid-feedback">Please Enter the Address</div>
                            <div class="valid-feedback">Address Valid</div>
                        </div>


                        <div class="modal-footer py-0 border-0 ">
                            <button type="submit" class="btn btn-primary rounded-2 px-3 py-1 m-0 " id="btn-submit"></button>
                        </div>
                    </form> --}}

    <script type="module">
        $(document).ready(function () {

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
                        return `<button class="ui icon button" style="padding: 0; background:transparent;">
                                    <i class="edit outline small bordered colored icon green"></i>
                                </button>

                                <button class="ui icon button" style="padding: 0; background:transparent;">
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
        //  $('#form_modal').modal('show');
        $('#btn_add_record').on('click', function () {
            $('#form_modal').modal('show');
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

        $('#btn_main_submit').on('click', function (e) {
            e.preventDefault()
            $('.ui.primary.submit.button').trigger('click');
        });

        $('.ui.negative.red.button').on('click', function () {
            $('.ui.form').form('reset')
        });
    });
    </script>
</x-app-layout>
