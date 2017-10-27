# 1
SELECT * FROM employees WHERE firstName IN ("Barry", "Larry", "Leslie") ORDER BY firstName;

# 2
SELECT * FROM products ORDER BY buyPrice DESC LIMIT 3;

# 3
SELECT * FROM products ORDER BY quantityInStock LIMIT 3;

# 4
SELECT
  offices.*, count(employees.employeeNumber) AS count_employees
FROM offices JOIN employees ON offices.officeCode = employees.officeCode
GROUP BY offices.officeCode HAVING count_employees > 4;

# 5 Получить список заказаов (orders), в которых было заказано более 10 товаров.
SELECT
  orders.*, count(orderdetails.productCode) product_count
FROM orders JOIN orderdetails ON orders.orderNumber = orderdetails.orderNumber
GROUP BY orders.orderNumber HAVING product_count > 10;

# 6 Получить полный список сотрудников (employees), для каждого сотрудника получить количество привязанных к нему покупателей (customers).
SELECT employees.*, count(customers.customerNumber)
FROM employees LEFT JOIN customers ON employees.employeeNumber = customers.salesRepEmployeeNumber
GROUP BY employees.employeeNumber;

# *7. Получить список офисов (offices), для каждого из них получить количество заказов за 2005 год. Выводить толко те офисы, в которых было сделано более 5 заказов.;
SELECT
  offices.*, count(orders.orderNumber) orders_count
FROM offices JOIN employees ON offices.officeCode = employees.officeCode
  JOIN customers ON employees.employeeNumber = customers.salesRepEmployeeNumber
  JOIN orders ON customers.customerNumber = orders.customerNumber
WHERE YEAR(orders.orderDate) = "2005" GROUP BY offices.officeCode HAVING orders_count > 5;

# *8. Получить список типов товаров (productlines), для каждого из них вывести количество заказов, в которых присутствуют товары с этим типом.
SELECT productlines.*, count(DISTINCT orderdetails.orderNumber) orders_count
FROM productlines JOIN products ON productlines.productLine = products.productLine
  JOIN orderdetails ON products.productCode = orderdetails.productCode
GROUP BY productlines.productLine
