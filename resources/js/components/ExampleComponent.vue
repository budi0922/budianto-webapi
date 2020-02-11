<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div  class="card-header"><center>{{judul}}</center></div>
                    <div v-if="!loading" class="card-body">
                        <input v-model="keyword" type="search" placeholder="Masukan kata kunci" @change="runSearch">
                        <button class="btn btn-info" @click="resetData" style="color : #fff"> Reset</button>
                        <button class="btn btn-info" @click="aksesApi" style="color : #fff"> Refresh</button>
                        <hr/>

                        <P/>

                        <table v-if="!error" class="table table-bordered table-info">
                            <tr style="background : #55b7e6">
                                <td>Nama</td>
                                <td>JK</td>
                                <td>Tanggal Dibuat</td>

                            </tr>
                            <tr v-for="item in content.data" :key="item.id" >
                                <td>
                                    {{ item.nama }}
                                </td>
                                <td>
                                    {{ item.jk }}
                                </td>
                                <td>
                                    {{ item.created_at }}
                                </td>
                            </tr>

                        </table>
                        <pagination :data="content" @pagination-change-page="aksesApi"></pagination>
                        <!-- @ = event -->
                    </div>
                    <div v-if="error" class="alert alert-warning" @click="aksesApi" >
                                    {{ error }}
                    </div>
                     <div v-if="loading" class="card-body"><center> Loading...</center></div>
                </div>
                <vue-progress-bar></vue-progress-bar>
                <notifications group="foo"/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                judul : 'Data Siswa',
                content : {},
                error : null,
                loading : false,
                keyword : '',
            }
        },
        mounted() {
            this.aksesApi()
        },

        methods: {
            aksesApi(page = 1, keyword){
                this.$Progress.start()
                this.loading = true

            const params = {
                page: page
            }

            if (keyword) {
                params.keyword = keyword

            }
                axios.get('/testapi', {params})
                // .then()   untuk memproses data apabila respon sukses
                // .catch()  untuk memproses data apabila respon gagal
                .then(res=> {
                    this.content = res.data
                    this.loading = false
                    this.$Progress.finish()
                    this.$notify({
                        type: 'bg-success',
                        group: 'foo',
                        title: 'Important message',
                        text: 'Hello user! This is a notification!'
                        });

                })
                .catch(error => {
                    this.error = error
                    this.loading = false
                    this.$Progress.fail()
                    this.$notify({
                        type: 'bg-danger',
                        group: 'foo',
                        title: 'Important message',
                        text: 'Hello user! error!'
                        });

                })
            },

            runSearch() {
                this.aksesApi(1, this.keyword)
            },
            resetData() {
                this.keyword =''
                this.aksesApi()
            }
        }
    }
</script>
