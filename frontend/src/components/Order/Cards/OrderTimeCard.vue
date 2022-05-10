<template>
  <q-splitter
    v-model="splitterModel"
  >

    <template v-slot:before>
      <q-tab-panels
        v-model="date"
        animated
        transition-prev="jump-up"
        transition-next="jump-up"
      >

          <q-tab-panel v-for="item in dateArray" :name="item.date" :key="item.date">
            <div class="text-h4 q-mb-md">2022/06/01</div>
            <div>
                <span class="time" v-for="time in item.timeArray" :key="time">{{ getTime(time.value) }}</span>
            </div>
          </q-tab-panel>

      </q-tab-panels>
    </template>

    <template v-slot:after>
      <div class="q-pa-md">
        <q-date
          v-model="date"
          :events="availableDate"
          :options="availableDate"
          :event-color="'green'"
        ></q-date>
      </div>
    </template>

  </q-splitter>

</template>

<script>
import {onMounted, onUpdated, ref} from 'vue';
export default {
  name: "OrderStepperTime",

  setup(){
    const dateArray = [
      {
        date:'2022/06/01', //дата
        timeArray:[
          {
            value: 1000, //время в минутах от полуночи
            id: 1 //ид времени
          }
        ]
      },
      {
        date:'2022/06/03',
        timeArray:[ { value: 600, id: 2 }, { value: 660, id: 2 }, { value: 690, id: 2 }]
      },
      {
        date:'2022/06/05',
        timeArray:[ { value: 630, id: 2 }, { value: 660, id: 2 }, { value: 720, id: 2 }]
      },
    ]

    const getTime = (int) => {
      return ('0' + (Math.trunc(int/60)).toString()).slice(-2) + ':' + ('0' + (int % 60).toString()).slice(-2);
    };

    let availableDate = [];

    const getDate = () => {
      dateArray.forEach(item=>
        availableDate.push(item.date));
    }
    getDate();

    return{
      splitterModel: ref(60),
      date: ref('2022/06/01'), //текущая дата
      availableDate, //маркеры
      dateArray, //массив объектов с временем
      getTime,
    }
  }
}
</script>

<style lang="scss">
.block{
//цвет доступных дат
}

.q-date__event{
  bottom: unset;
  height: 30px;
  width: 30px;
  //border-radius: 50%;
  z-index: -1;
}

.time{
  width: 50px;
  height: 20px;
  background-color: #21BA45;
  margin-right: 5px;
}

</style>
