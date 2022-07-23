<template>
  <div class="column items-center">
    <div class="col">

      <q-list>
        <q-item>

            Date of visit: {{ formattedDate }}

        </q-item>

        <q-item>
          <q-item-section> Your master: {{ master.name + ' ' + master.surname }}</q-item-section>
          <q-item-section avatar>
            <q-avatar>
              <img :src="hostUrl + master.pathToPhoto">
            </q-avatar>
          </q-item-section>
        </q-item>

        <q-item>
          <q-item-section> Service: {{service.name }}</q-item-section>
          <q-item-section avatar>
            <q-avatar>
              <img :src="hostUrl + service.pathToPhoto">
            </q-avatar>
          </q-item-section>
        </q-item>

        <q-item>
          <q-item-section> Time: {{ time.formattedTime }}</q-item-section>
        </q-item>

        <q-item>
          <q-item-section>
            <OrderField
              label="Name"
              v-model="order.client_name"
            />
          </q-item-section>
        </q-item>

        <q-item>
          <q-item-section>
            <OrderField
              label="Phone"
              v-model="order.phone"
            />
          </q-item-section>
        </q-item>

        <q-item>
          <OrderField
            label="E-mail"
            v-model="order.email"
          />
        </q-item>

        <q-item>
          <OrderField
            label="Telegram"
            v-model="order.telegram"
          />
        </q-item>

        <q-item>
          <q-checkbox v-model="order.notification_type" label="Send notification"/>
        </q-item>

        <q-item>
          <q-btn
            class="q-ml-sm full-width"
            color="green"
            label="Confirm"
            :disable="!readySend"
            @click="sendOrder"
          />
        </q-item>

      </q-list>

    </div>
  </div>

</template>

<script>
import {computed, ref, watch} from "vue"
import useMaster from "src/hooks/useMaster";
import OrderField from "components/Order/OrderField";
import axios from "axios";

export default {
  name: "OrderStepperConfirm",

  components: {
    OrderField
  },

  setup() {
    const {master, mountMaster, orderInfo} = useMaster();
    mountMaster();

    const {date, time, service} = orderInfo.value

    const hostUrl = process.env.HOST;

    //форматировние даты для вывода в карточку
    const dateToString = (string) => {
      const date = new Date(string)
      return date.getDate() + ' ' + date.toLocaleString('en-EN', { month: 'long' }) + ' ' + date.getFullYear()
    }

    const formattedDate = dateToString(date)

    const order = ref({
      client_name: '',
      phone: '',
      email: '',
      telegram: '',
      notification_type: false,

      client_id: null,
      price: 1000,
      duration: 1,

      master_id: master.value.id,
      service_id: service.id,
      time_id: time.time_id,
    })

    const readySend = computed(()=>{
      if (order.value.client_name && order.value.phone && order.value.email && order.value.telegram) {
        return true
      } else {
        return false
      }
    })

    const sendOrder = () => {
      console.log('order.value', order.value)
      axios.post('api/orders', order.value)
        .then(response => {
          console.log('response', JSON.parse(response.data));
        })
        .catch(error => {
          console.log('error', error);
        });
    }

    return {
      order,
      sendOrder,
      master,
      hostUrl,
      readySend,
      formattedDate, time, service
    }
  }
}
</script>

<style lang="scss">

</style>
