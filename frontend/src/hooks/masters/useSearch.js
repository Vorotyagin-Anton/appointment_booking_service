import {api} from "boot/api";
import useList from "src/hooks/masters/useList";
import useLoading from "src/hooks/masters/useLoading";
import logger from "src/logger";

export default function useSearch() {
  const {startLoading, stopLoading} = useLoading();

  const {putItems, flushItems} = useList();

  return async (value) => {
    try {
      await startLoading();

      const {items, totalPages, currentPage} = await api.masters.getByName(value);

      await flushItems();

      await putItems(items, totalPages, currentPage);
    } catch (error) {
      logger(error);
    } finally {
      await stopLoading();
    }
  };
}
