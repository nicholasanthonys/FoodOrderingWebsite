import axios from "axios";

export const createOrder = async (order) => {
  console.log("from axios order is");
  console.log(order);
  return axios.post("/api/orders", {
      email : order.email,
      totalPrice : order.totalPrice,
      orderStatus : order.orderStatus,
      paid : order.paid,
      menus : order.menus
  });
};
