<template>
    <div class="card text-white bg-dark mt-4">
        <div class='card-header'>Kusonime Update Terbaru</div>
        <div class='card-body'>
            <div class="table-responsive">
                <table class="table table-striped text-white">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Anime</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(url, index) in datanya.url[0]" :key="url">
                            <td>{{ index+1 }}</td>
                            <td>{{ datanya.nama[0][index] }}</td>
                            <td>{{ url }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            datanya : {
                url : [],
                nama : [],
                title : []
            }
        };
    },
    async mounted() {
        axios.get('/api/fetchNew').then( async(response) => {
            const data = response.data;

            const task = [
                this.fetchUrls(data.url),
                this.fetchNama(data.title),
                this.fetchTitle(data.title)
            ];

            await Promise.all(task);
        })
    },
    methods: {
        fetchUrls(arr) {
            this.datanya.url.push(arr);
        },
        fetchNama(arr) {
            this.datanya.nama.push(arr);
        },
        fetchTitle(arr) {
            this.datanya.title.push(arr);
        }
    }
}
</script>