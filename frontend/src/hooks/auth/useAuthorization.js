import {api} from "boot/api";
import useAlertMessage from "src/hooks/auth/useAlertMessage";

export default function () {
  const {showError} = useAlertMessage();

  const authorize = async (email, password) => {
    try {
      const response = await api.auth.signin(email.value, password.value);
    } catch (error) {
      console.dir(error);
      showError(error.response.data.detail);
    }
  };

  return {
    authorize,
  }
}
