# Toggle Free Shipping By Subtotal
Free shipping in Magento usually works with subtotal. However, there are use cases where users might not want to supply free shipping based on subtotal.

Cart rules can be used to create completely custom free shipping rules. Example cart rule for product SKU based free shipping:

```
Coupon: No Coupon
Conditions: blank
Actions -> Apply to Shipping Amount: yes

Apply the rule only to cart items matching the following conditions (leave blank for all items).
If ALL of these conditions are TRUE:
SKU
is {{selected_sku}}

Free Shipping: For shipment with matching items
```

In the above example free shipping would still apply if the cart met the subtotal. This module allows admin users to disable that functionality.
