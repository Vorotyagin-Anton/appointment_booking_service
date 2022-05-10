import {api} from "boot/api";
import useList from "src/hooks/masters/useList";
import useLog from "src/hooks/common/useLog";
import useLoading from "src/hooks/masters/useLoading";

export default function useSearch() {
  const log = useLog();

  const {startLoading, stopLoading} = useLoading();

  const {putItems, flushItems} = useList();

  return async (value) => {
    try {
      await startLoading();

      const {items, totalPages, currentPage} = await api.masters.getByName(value);

      await flushItems();

      await putItems(items, totalPages, currentPage);
    } catch (error) {
      log(error)
    } finally {
      await stopLoading();
    }
  };
}
