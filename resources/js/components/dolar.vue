<template>
    <div class="container">
        <div class="row header-row">
            <div class="col m4 d-flex justify-content-center">
                <VueDatePicker
                    v-model="date"
                    value="YYYY-MM-DD"
                    :locale="locale"
                    :min-date="1977 - 1"
                    :max-date="maxDate"
                ></VueDatePicker>
            </div>
            <div class="col m4 d-flex justify-content-center">
                <button type="button" class="btn btn-primary" @click="getDolar()">
                    Mostrar por Pantalla
                </button>
            </div>
            <div class="col m4 d-flex justify-content-center">
                <button
                    type="button"
                    class="btn btn-primary"
                    @click="getDolarExcel()"
                >
                    Descargar Excel
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col m12 d-flex justify-content-center">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data, index) in dolarData" :key="index">
                        <td>{{ data.fecha }}</td>
                        <td>{{ data.valor }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</template>

<script>
const actualDate = new Date();
export default {
    data() {
        return {
            date: new Date(),
            locale: {
                lang: "es",
                weekDays: ["L", "M", "M", "J", "V", "S", "D"],
            },
            maxDate:
                actualDate.getFullYear() + "-" + (actualDate.getMonth() + 1) + "-"+(actualDate.getDate()),
            dolarData: [],
        };
    },
    methods: {
        getDolar() {
            let selectedDate = new Date(this.date);
            let year = selectedDate.getFullYear();
            let month = selectedDate.getMonth() + 1;
            self = this;
            axios
                .get("api/dolar", { params: { year: year, month: month } })
                .then(response => {
                    self.dolarData = response.data;
                });
        },

        getDolarExcel() {
            let selectedDate = new Date(this.date);
            let year = selectedDate.getFullYear();
            let month = selectedDate.getMonth() + 1;
            self = this;
            axios
                .get("api/dolar/exportxls", {
                    params: { year: year, month: month },
                    responseType: "blob"
                })
                .then(response => {
                    const url = window.URL.createObjectURL(
                        new Blob([response.data])
                    );
                    const link = document.createElement("a");
                    link.href = url;
                    link.setAttribute("download", year+"-"+month+" Dolar.xlsx");
                    document.body.appendChild(link);
                    link.click();
                });
        }
    }
};
</script>

<style scoped>

.header-row{
    margin-top:40px;
    margin-bottom: 40px;
}
</style>
