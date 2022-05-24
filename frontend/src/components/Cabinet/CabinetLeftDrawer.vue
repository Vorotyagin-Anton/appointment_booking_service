<template>
  <div class="cabinet-left-drawer">
    <q-list class="cabinet-left-drawer__list">
      <q-item class="cabinet-left-drawer__item">
        <q-item-section class="cabinet-left-drawer__title">Quick access</q-item-section>
      </q-item>

      <router-link :to="{name: 'cabinet'}">
        <q-item class="cabinet-left-drawer__item" clickable v-ripple>
          <q-item-section class="cabinet-left-drawer__section" avatar>
            <svg aria-labelledby="ember62__title" role="img" height="28" width="28" viewBox="0 0 28 28" id="ember62"
                 class="cabinet-left-drawer__icon cabinet-left-drawer__home">
              <title id="ember62__title"></title>
              <path xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"
                    d="M14.6508 6.24074C14.2763 5.91975 13.7237 5.91975 13.3492 6.24074L6.34923 12.2407C5.9299 12.6002 5.88134 13.2315 6.24076 13.6508C6.43844 13.8814 6.71836 13.9999 7.00002 14V21C7.00002 21.5523 7.44773 22 8.00002 22H12H16H20C20.5523 22 21 21.5523 21 21V14C21.2817 13.9999 21.5616 13.8814 21.7593 13.6508C22.1187 13.2315 22.0701 12.6002 21.6508 12.2407L20 10.8258V9C20 8.44772 19.5523 8 19 8C18.4477 8 18 8.44772 18 9V9.11149L14.6508 6.24074ZM15 16V20H13V16H15ZM17 15V20H19V12.6028L14 8.31708L9.00002 12.6028V20H11V15C11 14.4477 11.4477 14 12 14H16C16.5523 14 17 14.4477 17 15Z"
                    fill="white"></path>
            </svg>
          </q-item-section>

          <q-item-section class="cabinet-left-drawer__text">Home</q-item-section>
        </q-item>
      </router-link>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__section" avatar>
          <svg aria-labelledby="ember65__title" role="img" height="28" width="28" viewBox="0 0 28 28" id="ember65"
               class="cabinet-left-drawer__icon cabinet-left-drawer__appointments">
            <title id="ember65__title"></title>
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M10 6C10.5523 6 11 6.44772 11 7V8H17V7C17 6.44772 17.4477 6 18 6C18.5523 6 19 6.44772 19 7V8H20.2222C20.6257 8 21.0585 8.10791 21.4125 8.39237C21.7854 8.69204 22 9.13527 22 9.625V13V18.375C22 18.8647 21.7854 19.308 21.4125 19.6076C21.0585 19.8921 20.6257 20 20.2222 20H7.77778C7.37433 20 6.94149 19.8921 6.5875 19.6076C6.21456 19.308 6 18.8647 6 18.375V13V9.625C6 9.13527 6.21456 8.69204 6.5875 8.39237C6.94149 8.10791 7.37433 8 7.77778 8H9V7C9 6.44772 9.44772 6 10 6ZM18 10H10H8V12H20V10H18ZM8 14H20V18H8V14ZM7.74771 10.002C7.74769 10.002 7.74854 10.0018 7.75035 10.0015L7.74771 10.002ZM7.74771 17.998L7.75035 17.9985C7.74854 17.9982 7.74769 17.998 7.74771 17.998ZM20.2523 17.998C20.2523 17.998 20.2515 17.9982 20.2496 17.9985L20.2523 17.998ZM20.2523 10.002L20.2496 10.0015C20.2515 10.0018 20.2523 10.002 20.2523 10.002Z"
                  fill="white"></path>
          </svg>
        </q-item-section>

        <q-item-section class="cabinet-left-drawer__text">Appointments</q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__section" avatar>
          <svg aria-labelledby="ember68__title" role="img" height="28" width="28" viewBox="0 0 28 28" id="ember68"
               class="cabinet-left-drawer__icon cabinet-left-drawer__customers">
            <title id="ember68__title"></title>
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M9 12C9 11.4477 9.44772 11 10 11C10.5523 11 11 11.4477 11 12C11 12.5523 10.5523 13 10 13C9.44772 13 9 12.5523 9 12ZM10 9C8.34315 9 7 10.3431 7 12C7 12.9911 7.48059 13.8699 8.22144 14.4162C6.90478 15.0709 6 16.4298 6 18C6 18.5523 6.44772 19 7 19C7.55228 19 8 18.5523 8 18C8 16.8954 8.89543 16 10 16C11.1046 16 12 16.8954 12 18C12 18.5523 12.4477 19 13 19C13.5523 19 14 18.5523 14 18C14 16.4298 13.0952 15.0709 11.7786 14.4162C12.5194 13.8699 13 12.9911 13 12C13 10.3431 11.6569 9 10 9ZM16 12C16 11.4477 16.4477 11 17 11H21C21.5523 11 22 11.4477 22 12C22 12.5523 21.5523 13 21 13H17C16.4477 13 16 12.5523 16 12ZM17 15C16.4477 15 16 15.4477 16 16C16 16.5523 16.4477 17 17 17H20C20.5523 17 21 16.5523 21 16C21 15.4477 20.5523 15 20 15H17Z"
                  fill="white"></path>
          </svg>
        </q-item-section>

        <q-item-section class="cabinet-left-drawer__text">Customers</q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__section" avatar>
          <svg aria-labelledby="ember71__title" role="img" height="28" width="28" viewBox="0 0 28 28" id="ember71"
               class="cabinet-left-drawer__icon cabinet-left-drawer__reports">
            <title id="ember71__title"></title>
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M16 7C15.4477 7 15 7.44772 15 8V12H13V11C13 10.4477 12.5523 10 12 10H8C7.44772 10 7 10.4477 7 11V20C7 20.5523 7.44772 21 8 21H12H16H20C20.5523 21 21 20.5523 21 20V8C21 7.44772 20.5523 7 20 7H16ZM15 19V14H13V19H15ZM17 19H19V9H17V13V19ZM11 12V13V19H9V12H11Z"
                  fill="white"></path>
          </svg>
        </q-item-section>

        <q-item-section class="cabinet-left-drawer__text">Reports</q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__section" avatar>
          <svg aria-labelledby="ember74__title" role="img" height="28" width="28" viewBox="0 0 28 28" id="ember74"
               class="cabinet-left-drawer__icon cabinet-left-drawer__transactions">
            <title id="ember74__title"></title>
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M16.2929 12.2929C15.9024 12.6834 15.9024 13.3166 16.2929 13.7071C16.6834 14.0976 17.3166 14.0976 17.7071 13.7071L20.6978 10.7163C20.8842 10.5346 21 10.2808 21 10C21 9.71916 20.8842 9.46536 20.6978 9.28372L17.7071 6.29291C17.3166 5.90238 16.6834 5.90236 16.2929 6.29288C15.9024 6.6834 15.9024 7.31656 16.2929 7.70709L17.5857 9H8C7.44772 9 7 9.44772 7 10C7 10.5523 7.44772 11 8 11H17.5857L16.2929 12.2929ZM11.7071 20.2929C12.0976 20.6834 12.0976 21.3166 11.7071 21.7071C11.3166 22.0976 10.6834 22.0976 10.2929 21.7071L7.30223 18.7163C7.11579 18.5347 7 18.2809 7 18C7 17.7191 7.11578 17.4653 7.30221 17.2837L10.2929 14.2929C10.6834 13.9024 11.3166 13.9024 11.7071 14.2929C12.0976 14.6834 12.0976 15.3166 11.7071 15.7071L10.4143 17H20C20.5523 17 21 17.4477 21 18C21 18.5523 20.5523 19 20 19H10.4143L11.7071 20.2929Z"
                  fill="white"></path>

          </svg>
        </q-item-section>

        <q-item-section class="cabinet-left-drawer__text">Transactions</q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__section" avatar>
          <svg aria-labelledby="ember77__title" role="img" height="28" width="28" viewBox="0 0 28 28" id="ember77"
               class="cabinet-left-drawer__icon cabinet-left-drawer__balance">
            <title id="ember77__title"></title>
            <path fill="none"
                  d="M21 11v-1a1 1 0 00-1-1h-1m2 2h-1a1 1 0 01-1-1V9m2 2v6m-2-8H9m12 8v1a1 1 0 01-1 1h-1m2-2h-1a1 1 0 00-1 1v1m0 0H9m0 0H8a1 1 0 01-1-1v-1m2 2v-1a1 1 0 00-1-1H7m0 0v-6m0 0v-1a1 1 0 011-1h1m-2 2h1a1 1 0 001-1V9m7 5a2 2 0 11-4 0 2 2 0 014 0z"
                  stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>

          </svg>
        </q-item-section>

        <q-item-section class="cabinet-left-drawer__text">Balance</q-item-section>
      </q-item>
    </q-list>

    <div class="cabinet-left-drawer__separator"></div>

    <q-list class="cabinet-left-drawer__list">
      <q-item class="cabinet-left-drawer__item">
        <q-item-section class="cabinet-left-drawer__title">All products</q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__text">Customers</q-item-section>

        <q-item-section side>
          <q-icon name="navigate_next"/>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__text">Items & orders</q-item-section>

        <q-item-section side>
          <q-icon name="navigate_next"/>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__text">Ecommerce</q-item-section>

        <q-item-section side>
          <q-icon name="navigate_next"/>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__text">Payments</q-item-section>

        <q-item-section side>
          <q-icon name="navigate_next"/>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__text">Reporting</q-item-section>

        <q-item-section side>
          <q-icon name="navigate_next"/>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__text">Banking</q-item-section>

        <q-item-section side>
          <q-icon name="navigate_next"/>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__text">Staff</q-item-section>

        <q-item-section side>
          <q-icon name="navigate_next"/>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__text">POS system</q-item-section>

        <q-item-section side>
          <q-icon name="navigate_next"/>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-left-drawer__item" clickable v-ripple>
        <q-item-section class="cabinet-left-drawer__text">Settings</q-item-section>

        <q-item-section side>
          <q-icon name="navigate_next"/>
        </q-item-section>
      </q-item>
    </q-list>
  </div>
</template>

<script>
export default {
  name: "CabinetLeftDrawer",
}
</script>

<style lang="scss">
.cabinet-left-drawer {

  &__list {
    padding: 10px 15px;
  }

  &__item {
    border-radius: 7px;

    .q-focus-helper {
      background: $primary !important;
    }
  }

  &__title {
    font-size: 15px;
    font-weight: 500;
  }

  &__text {
    font-size: 16px;
    font-weight: 500;
    color: $black;
  }

  &__separator {
    margin: 15px 0;
    width: 100%;
    height: 10px;
    background-color: $grey-3;
  }

  &__icon {
    display: block;
    border-radius: 5px;
    width: 28px;
    height: 28px;
  }

  &__home {
    background-color: #5f6a7d;
  }

  &__appointments {
    background-color: #77ba1b;
  }

  &__customers {
    background-color: #a1499c;
  }

  &__reports {
    background-color: #7250a1;
  }

  &__transactions {
    background-color: #7250a1;
  }

  &__balance {
    background-color: #7250a1;
  }
}
</style>
