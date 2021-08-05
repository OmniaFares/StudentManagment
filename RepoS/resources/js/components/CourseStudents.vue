<template>
  <div>
    <h4>Students That have Been Enrolled in {{ courseCode }}</h4>
    <div class="row">
      <div class="col-lg-6">
        <div class="main-card mb-3 card">
          <div class="card-body">

            <table class="mb-0 table table-bordered">
              <thead>
                <tr>
                  <th> #</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Identifier</th>
                  <th>E-mail</th>
                </tr>
              </thead>
              <tr v-for="student in students" v-bind:key="student.FirstName">
                <td>{{ student.id }}</td>
                <td>{{ student.FirstName }}</td>
                <td>{{ student.LastName }}</td>
                <td>{{ student.Identifier }}</td>
                <td>{{ student.Email }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

    <h4>Students That haven't Enrolled in {{ courseCode }}</h4>
    <div class="row">
      <div class="col-lg-8">
        <div class="main-card mb-5 card">
          <div class="card-body">
            <table class="mb-0 table table-bordered">
              <thead>
                <tr>
                  <th> #</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Identifier</th>
                  <th>E-mail</th>
                  <th>Enroll</th>
                </tr>
              </thead>
              <tr v-for="student in students2" v-bind:key="student.FirstName">
                <td>{{ student.id }}</td>
                <td>{{ student.FirstName }}</td>
                <td>{{ student.LastName }}</td>
                <td>{{ student.Identifier }}</td>
                <td>{{ student.Email }}</td>
                <td> <button class="btn badge-success" @click="Enroll(student)">Enroll</button> </td>
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
      courseCode: this.$route.params.courseCode,
      id: this.$route.params.id,
      students: [],
      student: {
        id: '',
        FirstName: '',
        LastName: '',
        Identifier: '',
        Email: '',
        DateOfBirth:  '',
        Level:   '',
        Program: '',
      },
       students2: [],
      student2: {
        id: '',
        FirstName: '',
        LastName: '',
        Identifier: '',
        Email: '',
        DateOfBirth:  '',
        Level:   '',
        Program: '',
      },
      enroll:{
        student:'',
        course:''
      },
      pagination: {},
      student_id: '',
    };
  },
  created() {
    this.fetchStudents();
    this.fetchStudents2();
  },
  methods: {
    fetchStudents(page_url) {
      let vm = this;
      page_url = page_url || "/api/students/" + this.id;
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.students = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch((err) => console.log(err));
    },
    fetchStudents2(page_url) {
      let vm = this;
      page_url = page_url || "/api/students2/" + this.id;
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.students2 = res.data;
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
    addStudent(){
                    //Add
                    fetch('/api/studentEnroll',{
                        method:     'post',
                        body:       JSON.stringify(this.enroll),
                        headers:{
                            'content-type':'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(data =>{
                    this.enroll.student=  '';
                    this.enroll.course=  '';
                            this.fetchStudents();
                            this.fetchStudents2();
                        })
                        .catch(err => console.log(err));
                
            },
            Enroll(student){
                this.enroll.student = student.id;
                this.enroll.course = this.id;
                    this.addStudent();
            },
  },
};
</script>
