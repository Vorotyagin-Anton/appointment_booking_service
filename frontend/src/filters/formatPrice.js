export default function formatPrice(value) {
  const parts = value.toString().split(".");
  const nums = parts[0].toString().split(".");
  nums[0] = nums[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  return nums.join(".") + (parts[1] !== undefined ? `.${parts[1]}` : '');
}
