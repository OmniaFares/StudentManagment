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
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>
<script>
 export default {
      data()
      {
          return{
              studentID: this.$route.params.studentID
          }
      }
    }
</script>
