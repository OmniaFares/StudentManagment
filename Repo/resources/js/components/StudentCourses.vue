<template>
    <div>
        <h4>Courses That {{studentID}} Have Been Enrolled</h4>
        <div class="row">
                <div class="col-lg-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Courses</h5>

                            <table class="mb-0 table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                    </tr>
                                </thead>
                                <tr v-for="course in courses" v-bind:key="course.Name">
                                        <th>{{course.Name}}</th>
                                        <th>{{course.Code}}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>
<script>
export default {
  data() {
    return {
      studentID: this.$route.params.studentID,
      id:this.$route.params.id,
      courses: [],
      course: {
        id: '',
        Name: '',
        Code: '',
        Description: '',
      },
      pagination: {},
      edit:       false,
    };
  },
  created() {
    this.fetchStudents();
  },
  methods: {
    fetchStudents(page_url) {
      let vm = this;
      page_url = page_url || '/api/courses/'+this.id;
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.courses = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch((err) => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev,
      };
      this.pagination = pagination;
    },
    deleteStudent(id){
                if(confirm('Are You Sure?')){
                    fetch(`api/course/${id}`,{
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
                if(this.edit === false){
                    //Add
                    fetch('api/course',{
                        method:     'post',
                        body:       JSON.stringify(this.student),
                        headers:{
                            'content-type':'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data =>{
                    this.student.Name=  '';
                    this.student.Code=  '';
                    this.student.Description= '';
                            this.fetchStudents();
                        })
                        .catch(err => console.log(err));
                }else{
                    //Update
                    fetch('api/course',{
                        method:     'put',
                        body:       JSON.stringify(this.student),
                        headers:{
                            'content-type':'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data =>{
                    this.student.Name=  '';
                    this.student.Code=  '';
                    this.student.Description= '';
                            this.fetchStudents();
                        })
                        .catch(err => console.log(err));
                }
            },
    editStudent(course){
                this.edit = true;
                this.course.id = course.id;
                this.course.course_id = course.id;
                this.course.Name=  course.Name;
                this.student.Code=  course.Code;
                this.student.Description= course.Description;
            },
    filter(selected,valueToSearch){
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
};
</script>
