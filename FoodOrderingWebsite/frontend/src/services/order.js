import axios from "axios";

export const createOrder = async (order) => {
  console.log("from axios order is");
  console.log(order);
  return axios.post("/api/orders", {
    email: order.email,
    totalPrice: order.totalPrice,
    // orderStatus: order.orderStatus,
    // paid: order.paid,
    menus: order.menus
  });
};

export const loadOrderHistory = async (email) => {
  return axios.post("/api/historyorders", {
    email: email,
  });
};

export const clearOrderHistory = async (email) => {
  console.log("from axios email is " + email);
  return axios.post("/api/historyorders/clear", {
    email: email,
  });
};
