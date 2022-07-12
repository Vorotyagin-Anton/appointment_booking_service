import {computed, ref} from "vue";

export default function () {
  const pass = ref('');
  const passRules = [
    value => value.length !== 0 || 'Please type your password!',
    value => value.length >= 6 || 'Password must have a minimum 6 characters',
  ];

  const passConfirmation = ref('');
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
