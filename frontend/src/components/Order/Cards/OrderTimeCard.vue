<template>
  <q-splitter
    v-model="splitterModel"
  >

    <template v-slot:before>
      <q-tab-panels
        v-model="panelDate"
        animated
        transition-prev="jump-up"
        transition-next="jump-up"
      >

        <q-tab-panel v-for="item in workerFreeTime" :name="formatDate(item.date)" :key="item.date">
          <div class="text-h4 q-mb-md"> {{ dateToString(item.date) }} </div>

            <div class="q-pa-md">
              <q-chip v-for="time in item.timeArray" :key="time.id"
                      clickable
                      @click="selectTime(item.date, time)"
                      :color="selectedTime === time.id ? 'secondary':'primary'"
                      text-color="white"
                      icon="watch_later">
                {{ formatTime(time.value) }}
              </q-chip>
            </div>

        </q-tab-panel>

        <q-tab-panel name="noTime" >

            <div class="q-pa-md">
              <h4 class="text-red">
                No entries for this day
              </h4>
            </div>

        </q-tab-panel>

      </q-tab-panels>
    </template>

    <template v-slot:after>
      <div class="q-pa-md">
        <q-date
          minimal
          v-model="date"
          :events="availableDate"
          :event-color="'green'"
        ></q-date>
      </div>
    </template>

  </q-splitter>

</template>

<script>
import {onMounted, onUpdated, ref, watch} from 'vue';
import useMaster from "src/hooks/useMaster";

export default {
  name: "OrderStepperTime",

  setup(){
    const {master, mountMaster, orderInfo, addTimeToOrder} = useMaster();

    const nowDate = new Date() //текущая дата

    const formattedNowDate = (date) => {
      return date.getFullYear() + '/' + ('0' + (date.getMonth() + 1).toString().slice(-2)) + '/' + ('0' + date.getDate().toString()).slice(-2)
    }

    const date = ref(formattedNowDate(nowDate)) //форматированная текущая дата
    const panelDate = ref( 'noTime') //дата в панеле
    const selectedDate = ref() //выбранная дата
    const selectedTime = ref() //выбранное время
    const availableDate = []; //маркеры возможных дат
    const { workerFreeTime } = master.value;
    const ObjectTime = ref()
    mountMaster();

    const formatTime = (int) => {
      return ('0' + (Math.trunc(int/60)).toString()).slice(-2) + ':' + ('0' + (int % 60).toString()).slice(-2);
    };

    //приведение формата даты прилетевшего из базы
    // к нужному в компоненте
    const formatDate = (date) => {
      if (typeof date !== "undefined"){
        return date.replace(/-/g, '/')
      }
    }

    //форматировние даты для вывода в карточку
    const dateToString = (string) => {
      const date = new Date(string)
      return date.getDate() + ' ' + date.toLocaleString('en-EN', { month: 'long' }) + ' ' + date.getFullYear()
    }

    //извлечение массива разрешенных дат
    const getAvailableDate = () => {
      workerFreeTime.forEach(item=> {
        const date = new Date(item.date)
        //добавляем даты дольше сегодняшней
        if (nowDate <= date){
          availableDate.push(formatDate(item.date));
        }
      })
    }

    getAvailableDate()

    const selectTime = (date, time) => {
      ObjectTime.value = time.value
      selectedDate.value = date
      selectedTime.value = time.id
    }

    watch(date,() => {
      if (availableDate.includes(date.value)){
        panelDate.value = date.value
      } else {
        panelDate.value = 'noTime'
      }
    })

    watch(selectedTime, (selectedTime, prevSelectedTime) => {
      const time = {
        time_id: selectedTime,
        time: ObjectTime.value,
        formattedTime: formatTime(ObjectTime.value)
    }
      addTimeToOrder(selectedDate.value, time)
    })


    return{
      selectedTime,
      availableDate,
      workerFreeTime,
      formatTime,
      formatDate,
      date,
      selectTime,
      dateToString,
      panelDate,

      splitterModel: ref(60),
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
