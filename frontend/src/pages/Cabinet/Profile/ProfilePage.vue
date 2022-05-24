<template>
  <div class="container profile-page">
    <div class="profile-page__content">

      <profile-menu
        class="profile-page__menu"
        :menu="menu"
        :selected-item="menuItem.id"
        @select="handleSelect"
      />

      <div class="profile-page__center">
        <component
          class="profile-page__main"
          v-if="menuItem"
          :is="menuItem.component"
        />
      </div>
    </div>

    <profile-footer class="profile-page__footer"/>
  </div>
</template>

<script>
import {onMounted, ref, shallowRef, watch} from "vue";
import ProfileMenu from "components/Cabinet/Profile/ProfileMenu";
import ProfileFooter from "components/Cabinet/Profile/ProfileFooter";
import ProfileAccount from "components/Cabinet/Profile/ProfileAccount";
import ProfileBusiness from "components/Cabinet/Profile/ProfileBusiness";
import ProfileSchedule from "components/Cabinet/Profile/ProfileSchedule";
import {useRoute, useRouter} from "vue-router";
import ProfilePricing from "components/Cabinet/Profile/ProfilePricing";

const menu = [
  {
    id: 1,
    title: 'Account',
    component: shallowRef(ProfileAccount),
    children: [
      {
        id: 1,
        title: 'Personal',
        to: {name: 'cabinet.profile', query: {sec: 1}, hash: '#personal'},
      },
      {
        id: 2,
        title: 'Contacts',
        to: {name: 'cabinet.profile', query: {sec: 1}, hash: '#contacts'},
      },
      {
        id: 3,
        title: 'Location',
        to: {name: 'cabinet.profile', query: {sec: 1}, hash: '#location'},
      },
    ],
  },
  {
    id: 2,
    title: 'Business',
    component: shallowRef(ProfileBusiness),
    children: [
      {
        id: 1,
        title: 'Services',
        to: {name: 'cabinet.profile', query: {sec: 2}, hash: '#services'},
      },
      {
        id: 2,
        title: 'Bank & Payment',
        to: {name: 'cabinet.profile', query: {sec: 2}, hash: '#payment'},
      },
    ],
  },
  {
    id: 3,
    title: 'Schedule',
    component: shallowRef(ProfileSchedule),
  },
  {
    id: 4,
    title: 'Pricing',
    component: shallowRef(ProfilePricing),
  }
];

export default {
  name: "ProfilePage",

  components: {
    ProfileFooter,
    ProfileMenu,
  },

  emits: [
    'toggle-left-drawer',
  ],

  setup(props, {emit}) {
    const route = useRoute();
    const router = useRouter();

    const menuItem = ref(menu[0]);

    const handleSelect = (id) => {
      menuItem.value = menu.find(item => item.id === id);
    };

    watch(route, () => {
      if (route.query.sec) {
        const item = menu.find(item => item.id === parseInt(route.query.sec));

        if (item) {
          menuItem.value = item;
        } else {
          router.push({name: '404'});
        }
      }
    });

    onMounted(() => {
      emit('toggle-left-drawer', {
        isOpen: false,
        isOverlay: true,
      });
    });

    return {
      menu,
      menuItem,
      handleSelect,
    }
  }
}
</script>

<style lang="scss">
.profile-page {
  &__content {
    padding: 0 15px 85px;
    display: flex;
  }

  &__menu {
    margin-right: 50px;
  }
}
</style>
