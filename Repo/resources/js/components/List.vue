
 <template>
 
<div>
    <link href="/css/main.css" rel="stylesheet">
    <div class="row">
        <div class="col-lg-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Students</h5>

                    <label class ="btn badge-success">Search by</label> 
                    <select style="width:200px;font-family: cursive; " v-model="selected"> 
                        <option name="IDentifier" > IDentifier</option> 
                        <option name="Level"> Level </option> 
                        <option name="Program"> Program </option> 
                    </select> 
                    <form @submit.prevent="filter(selected,valueToSearch)" style="display:inline"> 
                        <input type ="text" v-model="valueToSearch" >
                    <button class ="btn badge-success" type="submit" >Go</button> 
                    <button class ="btn badge-success" @click.prevent="fetchStudents('')" >All</button> 
                    </form>

                    <table class="mb-0 table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>IDentifier</th>
                                <th>E-mail</th>
                                <th>Date of birth</th>
                                <th>Level</th>
                                <th>Program</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tr v-for="student in students" v-bind:key="student.id">
                             <td>{{student.id}} </td>
                                <td>{{student.FirstName}} </td>
                                <td>{{student.LastName}}</td>
                                <td><router-link :to="`/StudentCourses/${student.Identifier}/${student.id}`">{{student.Identifier}}</router-link></td>
                                <td>{{student.Email}}</td>
                                <td>{{student.DateOfBirth}}</td>
                                <td>{{student.Level}}</td>
                                <td>{{student.Program}}</td>
                               <td> <button class="btn badge-success" @click="editStudent(student)">Edit</button> </td>
                               <td> <button class="btn badge-success" @click="deleteStudent(student.id)">Delete</button> </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <h4> Student</h4>
<form @submit.prevent="addStudent" class="md-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="first name" v-model="student.FirstName">
                 <input type="text" class="form-control" placeholder="last name" v-model="student.LastName">
                <input type="text" class="form-control" placeholder="identifier" v-model="student.Identifier">
                 <input type="text" class="form-control" placeholder="email" v-model="student.Email">
                <input type="text" class="form-control" placeholder="date Of Birth" v-model="student.DateOfBirth">
                 <input type="text" class="form-control" placeholder="level" v-model="student.Level">
                 <input type="text" class="form-control" placeholder="program" v-model="student.Program">
            </div>
            <!-- <button type="submit" class="btn badge-success">Save</button> -->
            <button type="submit" class="btn badge-success" > Update</button>
            <button type="submit" class="btn badge-success" >Add new Student</button>
        </form>
        <br><br>
    <div class="row">
        <div class="col-lg-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Courses</h5>
                    <table class="mb-0 table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tr v-for="course in courses" v-bind:key="course.id">
                                <th>{{course.id}}</th>
                                <th>{{course.Name}}</th>
                                <th>{{course.Code}}</th>
                                <th>{{course.Description}}</th>
                                <td> <button class="btn badge-success" @click="editCourse(course)">Edit</button> </td>
                               <td> <button class="btn badge-success" @click="deleteCourse(course.id)">Delete</button> </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <h4> Course</h4>
<form @submit.prevent="addCourse" class="md-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="name" v-model="course.Name">
                 <input type="text" class="form-control" placeholder="code" v-model="course.Code">
                <input type="text" class="form-control" placeholder="description" v-model="course.Description">
            </div>
            <!-- <button type="submit" class="btn badge-success">Save</button> -->
            <button type="submit" class="btn badge-success" >Update</button>
            <button type="submit" class="btn badge-success" >Add new Course</button>
        </form>
        <br><br>
        <div class="col-lg-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Levels</h5>
                    <table class="mb-0 table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Courses</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Programs</h5>
                    <table class="mb-0 table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Courses</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

   
</div>
</template>
<script>
  export default {
        data(){
            return{
                students:[],
                student:{
                    id:     '',
                    FirstName:  '',
                    LastName:   '',
                    Identifier: '',
                     Email:     '',
                    DateOfBirth:  '',
                    Level:   '',
                    Program: '',
                },
                courses: [],
                course: {
                    id: '',
                    Name: '',
                    Code: '',
                    Description: '',
                },
                student_id: '',
                course_id: '',
                pagination: {},
                editstudent:       false,
                editscourse:       false,
                valueToSearch: '',
                selected:''
            }
        },
        created(){
            this.fetchStudents();
            this.fetchCourses();
        },
        methods:{
            fetchStudents(page_url){
                let vm = this; 
                page_url = page_url || '/api/students';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.students = res.data;
                        vm.makePagination(res.meta, res.links);
                    })
                    .catch(err => console.log(err));
            },
            makePagination(meta, links){
                let pagination = {
                    current_page:   meta.current_page,
                    last_page:      meta.last_page,
                    next_page_url:  links.next,
                    prev_page_url:  links.prev
                };
                this.pagination = pagination;
            },
            deleteStudent(id){
                if(confirm('Are You Sure?')){
                    fetch(`api/student/${id}`,{
                        method:'delete'
                    })
                        .then(res => res.json())
                        .then(data =>{
                            this.fetchStudents();
                        })
                        .catch(err => console.log(err))
                }
            },
            addStudent(){
                if(this.editstudent === false){
                    //Add
                    fetch('api/student',{
                        method:     'post',
                        body:       JSON.stringify(this.student),
                        headers:{
                            'content-type':'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data =>{
                    this.student.FirstName=  '';
                    this.student.LastName=  '';
                    this.student.Identifier= '';
                     this.student.Email=     '';
                    this.student.DateOfBirth=  '';
                    this.student.Level=   '';
                    this.student.Program= '';
                            this.fetchStudents();
                        })
                        .catch(err => console.log(err));
                }else{
                    //Update
                    fetch('api/student',{
                        method:     'put',
                        body:       JSON.stringify(this.student),
                        headers:{
                            'content-type':'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data =>{
                    this.student.FirstName=  '';
                    this.student.LastName=  '';
                    this.student.Identifier= '';
                    this.student.Email=     '';
                    this.student.DateOfBirth=  '';
                    this.student.Level=   '';
                    this.student.Program= '';
                            this.fetchStudents();
                        })
                        .catch(err => console.log(err));
                }
            },
            editStudent(student){
                this.editstudent = true;
                this.student.id = student.id;
                this.student.student_id = student.id;
                     this.student.FirstName=  student.FirstName;
                    this.student.LastName=  student.LastName;
                    this.student.Identifier= student.Identifier;
                     this.student.Email=     student.Email;
                    this.student.DateOfBirth=  student.DateOfBirth;
                    this.student.Level=   student.Level;
                    this.student.Program= student.Program;
            },
            filter(selected,valueToSearch){
                let vm = this; 
                fetch(`api/students/${selected}/${valueToSearch}`)
                    .then(res => res.json())
                    .then(res => {
                        this.students = res.data;
                        vm.makePagination(res.meta, res.links);
                    })
                    .catch(err => console.log(err));

            },



            fetchCourses(page_url) {
                let vm = this;
                page_url = page_url || '/api/courses';
                fetch(page_url)
                    .then((res) => res.json())
                    .then((res) => {
                    this.courses = res.data;
                    vm.makePagination(res.meta, res.links);
                    })
                    .catch((err) => console.log(err));
                },
            deleteCourse(id){
                        if(confirm('Are You Sure?')){
                            fetch(`api/course/${id}`,{
                                method:'delete'
                            })
                                .then(res => res.json())
                                .then(data =>{
                                    this.fetchCourses();
                                })
                                .catch(err => console.log(err))
                        }
                    },
            addCourse(){
                        if(this.editcourse === false){
                            //Add
                            fetch('api/course',{
                                method:     'post',
                                body:       JSON.stringify(this.course),
                                headers:{
                                    'content-type':'application/json'
                                }
                            })
                                .then(res => res.json())
                                .then(data =>{
                            this.course.Name=  '';
                            this.course.Code=  '';
                            this.course.Description= '';
                                    this.fetchCourses();
                                })
                                .catch(err => console.log(err));
                        }else{
                            //Update
                            fetch('api/course',{
                                method:     'put',
                                body:       JSON.stringify(this.course),
                                headers:{
                                    'content-type':'application/json'
                                }
                            })
                                .then(res => res.json())
                                .then(data =>{
                            this.course.Name=  '';
                            this.course.Code=  '';
                            this.course.Description= '';
                                    this.fetchCourses();
                                })
                                .catch(err => console.log(err));
                        }
                    },
            editCourse(course){
                        this.editcourse = true;
                        this.course.course_id = course.id;
                        this.course.id = course.id;
                        this.course.Name=  course.Name;
                        this.course.Code=  course.Code;
                        this.course.Description= course.Description;
                    },
            filterCourse(selected,valueToSearch){
                        let vm = this; 
                        fetch(`api/courses/${selected}/${valueToSearch}`)
                            .then(res => res.json())
                            .then(res => {
                                this.courses = res.data;
                                vm.makePagination(res.meta, res.links);
                            })
                            .catch(err => console.log(err));

                    }
  },
        }
    
</script>
