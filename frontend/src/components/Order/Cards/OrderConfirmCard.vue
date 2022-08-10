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
              <img :src="master.pathToPhoto">
            </q-avatar>
          </q-item-section>
        </q-item>

        <q-item>
          <q-item-section> Service: {{service.service.name }}</q-item-section>
          <q-item-section avatar>
            <q-avatar>
              <img :src="service.service.pathToPhoto">
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

  <OrderResponseModal v-model="showModal">
    <p>88888</p>
  </OrderResponseModal>

</template>

<script>
import {computed, ref, watch, toRef} from "vue"
import axios from "axios";
import useMaster from "src/hooks/useMaster";
import OrderField from "components/Order/OrderField";
import OrderResponseModal from "components/Common/Modal/OrderResponseModal";
import useOrderModal from "src/hooks/order/useOrderModal";

export default {
  name: "OrderStepperConfirm",

  components: {
    OrderField,
    OrderResponseModal
  },

  setup() {
    const {master, mountMaster, orderInfo} = useMaster();
    const {closeOrderModal} = useOrderModal();

    mountMaster();

    const showModal = ref(false)
    const responseModalData = ref()

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
      notification_type: false,

      client_id: null,
      price: 1000,
      duration: 1,

      master_id: master.value.id,
      service_id: service.id,
      time_id: time.time_id,
    })

    const readySend = computed(function () {
      if (order.value.client_name && order.value.phone && order.value.email) {
        return true
      } else {
        return false
      }
    })

    const sendOrder = () => {
      //console.log('order.value', order.value)
      axios.post('api/orders', order.value)
        .then(response => {
          console.log('response', response.data);
          const responseData = response.data

          if (responseData.title === 'Validation Failed'){
            console.log('ошибка валидации, передать ошибку в форму');
            showModal.value = true;
          }
          if (responseData.id) {
            // closeOrderModal();
            showModal.value = true;
            console.log('показать окно с сообщением об удачной записи');
          }
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
      formattedDate, time, service,

      showModal,
      responseModalData,
    }
  }
}
</script>

<style lang="scss">

</style>
