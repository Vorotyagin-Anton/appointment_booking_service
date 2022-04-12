import {computed, ref} from "vue";

export default function () {
  const pass = ref(null);
  const passRules = [value => value && value.length >= 6 || 'Please type your password!',];

  const passConfirmation = ref(null);
  const isPassConfirmed = computed(() => pass.value === passConfirmation.value);
  const passConfirmationRules = [() => isPassConfirmed.value || 'Failed to confirm password!'];
    
  return {
    pass,
    passRules,
    passConfirmation,
    isPassConfirmed,
    passConfirmationRules,
  }
}
