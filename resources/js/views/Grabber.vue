<template>
    <div class="card text-white bg-dark mt-4">
        <div class='card-header'>Grab Link Download Kusonime</div>
        <div class='card-body'>
            <form @submit.prevent="grabData()">
                <div class="form-group">
                    <label>URL Kusonime* :</label>
                    <input type="text" v-model="data.url" class="form-control" required>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Ambil</button>
                </div>
            </form>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="exampleModalLabel">List Link Download</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped text-white">
                        <thead>
                            <tr>
                                <th>380P</th>
                                <th>480P</th>
                                <th>720P</th>
                                <th>1080P</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(url, index) in data.result['360P']" :key="url">
                                <td>{{ url }}</td>
                                <td>{{ data.result['480P'][index] }}</td>
                                <td>{{ data.result['720P'][index] }}</td>
                                <td>{{ data.result['1080P'][index] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            data: {
                url : '',
                result : {
                    '360P' : [],
                    '480P' : [],
                    '720P' : [],
                    '1080P' : []
                }
            }
        }
    },
    methods: {
        async grabData() {
            axios.post("api/grabUrl", {
                url : this.data.url
            }).then(async(response) => {
                const data = response.data;

                for(let reso in data) {
                    await Promise.all(data[reso].map(async(datar) => {
                        await Promise.all(datar.map(async(datars) => {
                            this.data.result[reso].push(datars);
                        }));
                    }));
                }

                console.log(this.data.result)
                $("#exampleModal").modal();
            })
        }
    }
}
</script>