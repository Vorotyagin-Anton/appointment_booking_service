import {api} from "boot/api";
import useAlertMessage from "src/hooks/auth/useAlertMessage";

export default function () {
  const {showError} = useAlertMessage();

  const register = async (email, password, isMaster) => {
    try {
      const response = await api.auth.signup(email.value, password.value, isMaster);
    } catch (error) {
      console.dir(error);
      showError(error.response.data.detail);
    }
  };

  return {
    register,
  }
}
