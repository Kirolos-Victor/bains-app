<template>
    <div class="card">
        <div class="card-header">Applications table</div>
        <div class="card-body">
            <form class="mb-3" id="search-form">
                <div class="row">
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Search by first name" name="first_name"
                               @input="getApplications">
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Search by last name" name="last_name"
                               @input="getApplications">
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Search by email address" name="email"
                               @input="getApplications">
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Search by phone" name="phone"
                               @input="getApplications">
                    </div>
                    <div class="col-3 mt-3" @change="getApplications">
                        <select class="form-select" name="job">
                            <option value="">Filter by job</option>
                            <option value="manager">Manager</option>
                            <option value="programmer">Programmer</option>
                            <option value="hr">HR</option>
                            <option value="support">Support</option>
                        </select>
                    </div>
                </div>
            </form>

            <table class="table table-striped">
                <thead class="bg-dark text-white">
                <tr>
                    <th>Submitted Date</th>
                    <th>Application ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <th>Job</th>
                    <th>Previous Experience</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="application in applications" v-if="applications.length>0">
                    <td>{{ application.created_at }}</td>
                    <th>{{ application.id }}</th>
                    <td>{{ application.first_name }}</td>
                    <td>{{ application.last_name }}</td>
                    <td>{{ application.email }}</td>
                    <td>{{ application.phone }}</td>
                    <td>{{ application.date_of_birth }}</td>
                    <td>{{ capitalizeFirstLetter(application.job) }}</td>
                    <td>{{ application.previous_experience }}</td>
                    <td>{{ capitalizeFirstLetter(application.status) }}</td>
                    <td class="d-inline-flex w-100" v-if="application.status =='approved'">
                        <button class="btn btn-secondary d-block w-100"
                                @click.prevent="approveApplication(application.id,'denied')">Deny
                        </button>
                        <button class="btn btn-danger d-block w-100" @click.prevent="deleteApplication(application.id)">
                            Delete
                        </button>
                    </td>
                    <td class="d-inline-flex w-100" v-else-if="application.status =='denied'">
                        <button class="btn btn-success d-block w-100"
                                @click.prevent="approveApplication(application.id,'approved')">Approve
                        </button>
                        <button class="btn btn-danger d-block w-100" @click.prevent="deleteApplication(application.id)">
                            Delete
                        </button>
                    </td>
                    <td class="d-inline-flex w-100" v-else>
                        <button class="btn btn-success w-100"
                                @click.prevent="approveApplication(application.id,'approved')">Approve
                        </button>
                        <button class="btn btn-secondary w-100"
                                @click.prevent="approveApplication(application.id,'denied')">Deny
                        </button>
                        <button class="btn btn-danger w-100" @click.prevent="deleteApplication(application.id)">Delete
                        </button>
                    </td>
                </tr>
                <tr v-else>
                    <td class="text-center" colspan="11">No data</td>
                </tr>

                </tbody>
            </table>
            <nav class="d-flex justify-content-center" v-if="pagination.total != 0">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" v-show="pagination.prev_page_url !=null"
                           @click.prevent="getApplications(pagination.prev_page_url.substring(pagination.prev_page_url.indexOf('=') + 1))">Previous</a>
                    </li>
                    <li class="page-item" v-for="page in pagination.last_page">
                        <a class="page-link"
                           @click="getApplications(page)">{{ page }}</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" v-show="pagination.next_page_url !=null"
                           @click.prevent="getApplications(pagination.next_page_url.substring(pagination.next_page_url.indexOf('=') + 1))">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
import {onMounted, ref} from "vue";
import Swal from "sweetalert2";

export default {
    name: "Application",
    setup() {
        const applications = ref([]);
        const pagination = ref({});

        function getApplications(page) {
            page === undefined ? page = 1 : page;

            let formData = new FormData(document.getElementById('search-form'));
            formData.append('page', page);
            axios.post('/admin/applications', formData).then((data) => {
                applications.value = data.data.data
                pagination.value = data.data;

            })
        }

        function approveApplication(id, status) {
            axios.post('/admin/applications/' + id, {status: status}).then(() => {
                window.location.reload();
            })

        }

        function deleteApplication(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/admin/applications/' + id).then(() => {
                        window.location.reload();
                    })
                }
            })
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        onMounted(() => {
            getApplications();
        })
        return {
            applications,
            pagination,
            getApplications,
            approveApplication,
            deleteApplication,
            capitalizeFirstLetter
        };
    }
}
</script>

<style scoped>
.btn {
    margin-left: 5px !important;
    margin-right: 5px !important;
    margin-bottom: 25px;
}
</style>
