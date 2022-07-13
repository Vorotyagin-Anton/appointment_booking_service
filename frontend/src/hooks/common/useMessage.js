import {onUnmounted, ref, watch} from "vue";

export default function () {
  const visible = ref(false);
  const type = ref('info');
  const message = ref('');
  const lifetime = ref(0);

  const show = (msgType, text, time = 0) => {
    visible.value = true;
    type.value = msgType;
    message.value = text;
    lifetime.value = time;
  };

  const showInfo = (text, time = 0) => show('info', text, time);

  const showSuccess = (text, time = 0) => show('success', text, time);

  const showError = (text, time = 0) => show('error', text, time);

  const hide = () => {
    visible.value = false;

    setTimeout(() => {
      type.value = 'info';
      message.value = '';
      lifetime.value = 0;
    }, 500)
  }

  let timeoutId = null;

  watch(lifetime, () => {
    if (lifetime.value > 0) {
      timeoutId = setTimeout(hide, lifetime.value);
    }
  });

  onUnmounted(() => {
    if (timeoutId) {
       clearTimeout(timeoutId);
    }

    hide();
  });

  return {
    visible,
    type,
    message,
    show,
    showInfo,
    showSuccess,
    showError,
    hide,
  }
}
