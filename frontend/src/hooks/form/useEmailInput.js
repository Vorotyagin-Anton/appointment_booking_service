import {ref, computed} from "vue";

export default function () {
  const email = ref(null);
  const emailRules = [value => value && value.length > 0 || 'Invalid email entered!'];

  const emailConfirmation = ref(null);
  const isEmailConfirmed = computed(() => email.value === emailConfirmation.value);
  const emailConfirmationRules = [() => isEmailConfirmed.value || 'Failed to confirm email!'];

  return {
    email,
    emailRules,
    emailConfirmation,
    isEmailConfirmed,
    emailConfirmationRules,
  }
}
