<template>
    <Bar
       :chart-options="chartOptions"
       :chart-data="chartData"
       :chart-id="chartId"
       :dataset-id-key="datasetIdKey"
       :plugins="plugins"
       :css-classes="cssClasses"
       :styles="styles"
       :width="10"
       :height="8"
   />
</template>

<script>
import {Bar, Pie, Doughnut} from 'vue-chartjs/legacy'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement)
export default {
    // eslint-disable-next-line vue/no-unused-components
    components: {Bar, Pie, Doughnut},
    props: {
         chartId: {
       type: String,
       default: 'bar-chart'
       },
       datasetIdKey: {
       type: String,
       default: 'label'
       },
       width: {
       type: Number,
       default: 15
       },
       height: {
       type: Number,
       default: 10
       },
       cssClasses: {
       default: '',
       type: String
       },
       styles: {
       type: Object,
       default: () => {}
       },
       plugins: {
       type: Object,
       default: () => {}
       },
       objectData: {
         type: Object,
         required: true
       },
       appName: {
         type: String,
         required: false
       }
    },
    data() {
         return {
              chartData: {
                   labels: [ 'Em curso', 'Continuo', 'Em curso com supervisor', 'Pendente','Concluido'/*, 'Não recebem newsletter' */],
                   datasets: [ { label: `Atividades`,  
                   backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgb(255, 99, 132, 0.2)',
                        'rgb(54, 162, 235, 0.2)',
                        'rgb(255, 205, 86, 0.2)',
                        'rgb(244, 129, 31, 0.2)'
                   ], 
                   borderColor: [
                        'rgba(75, 192, 192)',
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(244, 129, 31)'
                   ],
                   borderWidth: 1,
                   data: [
                        this.objectData.curso, 
                        this.objectData.continuo, 
                        this.objectData.supervisor,
                        this.objectData.pendente, 
                        this.objectData.concluido, 
                        // this.objectData.total_notReceiveNewsletter
                   ], hoverOffset: 1 } ]
              },
              chartOptions: {
                   responsive: true,
                   scales: {
                        y: {
                             beginAtZero: true
                        }
                   },
              }
         }
    }

}
</script>

<style>

</style>