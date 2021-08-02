
 <template>
 
<div>
    <link href="/css/main.css" rel="stylesheet">
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
                                <td><router-link :to="`/CourseStudents/${course.Code}/${course.id}`">{{course.Name}}</router-link></td>
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
            <button type="submit" class="btn badge-success" >Update</button>
            <button type="submit" class="btn badge-success" >Add new Course</button>
        </form>
        <br><br>  
</div>
</template>
<script>
  export default {
        data(){
            return{
                courses: [],
                course: {
                    id: '',
                    Name: '',
                    Code: '',
                    Description: '',
                },
                course_id: '',
                pagination: {},
                editcourse:       false,
                valueToSearch: '',
                selected:''
            }
        },
        created(){
            this.fetchCourses();
        },
        methods:{
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
                
                console.log(this.editcourse);
                        if(this.editcourse === false){
                            
                            console.log('In add');
                            //Add
                            fetch(`api/course`,{
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
                            console.log('In update');
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
