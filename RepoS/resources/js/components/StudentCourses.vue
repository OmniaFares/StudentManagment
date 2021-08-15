<template>
    <div>
        <h4>Courses That {{studentID}} has Enrolled in</h4>
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
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tr v-for="course in courses" v-bind:key="course.Name">
                                        <th>{{course.Name}}</th>
                                        <th>{{course.Code}}</th>
                                        <th><button class="btn badge-success"  @click="calcTotal(course.id)">Show grade </button></th>
                                </tr>
                            </table>
                            <div v-show="boolShow">
                              <table class="mb-0 table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Max</th>
                                    </tr>
                                </thead>
                                <tr v-for="grade in grades" v-bind:key="grade.Name">
                                        <th>{{grade.Name}}</th>
                                        <th>{{grade.Value}}</th>
                                        <th>{{grade.Max}}</th>
                                </tr>
                                <tr></tr>
                            </table>

                            </div>
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
      grades: [],
      grade: {
        courseID: '',
        studentID: '',
        Name:'',
        Value: '',
        Max: '',
      },
      pagination: {},
      boolShow: false,
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
    // makePagination(meta, links) {
    //   let pagination = {
    //     current_page: meta.current_page,
    //     last_page: meta.last_page,
    //     next_page_url: links.next,
    //     prev_page_url: links.prev,
    //   };
    //   this.pagination = pagination;
    // },
    calcTotal(courseid){
      let vm = this;
      this.boolShow = true;
    //  page_url = page_url || '/api/grades/'+this.id+courseid;
      fetch(`/api/grades/${this.id}/${courseid}`)
        .then(res => res.json())
        .then(res => {
          this.grades = res.data;
        //  vm.makePagination(res.meta, res.links);
        })
        .catch((err) => console.log(err));

    }
  },
};
</script>
