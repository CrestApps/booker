-- expense_categories
TRUNCATE TABLE Booker.expense_categories;
INSERT INTO Booker.expense_categories(id, name, created_at,updated_at)
SELECT category_id, title, CURRENT_DATE(), CURRENT_DATE() 
FROM crm.expenses_categories
WHERE type = 1;

-- maintenance_categories
TRUNCATE TABLE Booker.maintenance_categories;
INSERT INTO Booker.maintenance_categories(id, name, created_at,updated_at,is_active)
SELECT category_id, title, CURRENT_DATE(), CURRENT_DATE(), 1
FROM crm.expenses_categories
WHERE type = 2;

-- maintenance_records
TRUNCATE TABLE Booker.maintenance_records;
INSERT INTO Booker.maintenance_records(id, created_at, updated_at, vehicle_id, cost, paid_at, related_date, notes, payment_method, category_id)
SELECT Maintenance_id, addDate, addDate, vehicle_id, amount, payDate, relatedDate, notes, 'cash', maintenanceType
FROM crm.maintenance;

-- expenses
TRUNCATE TABLE Booker.expenses;
INSERT INTO Booker.expenses(id, created_at, updated_at, related_date, amount, category_id, notes, pay_date)
SELECT expense_id, addDate, addDate, relatedDate, amount, category,notes,payDate 
FROM crm.expenses;

-- checks
TRUNCATE TABLE Booker.checks;
INSERT INTO Booker.checks(id, created_at, updated_at,customer_id,total,due_date,status,reservation_id)
SELECT checks_id, firstActivity,lastActivity, customerId, checkValue,dueDate,'cleared', reservation_id
FROM crm.checks;

-- customers
TRUNCATE TABLE Booker.Customers;
INSERT INTO Booker.Customers
(id, created_at, updated_at,fullname,home_address, personal_identification_number, driver_license_number, birth_date, driver_license_issue_date, driver_license_experation_date,phone,is_black_listed,black_list_notes)
SELECT customerID,addDate, addDate,fullname,homeaddress,ID,dId
,CASE WHEN birthDate IS NULL THEN CONCAT(birthYear, '-12-01 00:00:00') ELSE birthDate END ,idissue, idExp, phone, black_listed, black_list_notes
FROM crm.customers

-- payable_checks
 TRUNCATE TABLE Booker.payable_checks;
 INSERT INTO Booker.payable_checks(id, created_at, updated_at, number, value, due_date, issue_date, expense_id, is_cashed)
 SELECT checkid, firstActivity,lastActivity,checkNumber,checkValue,CAST(checkDate AS DATE),CAST(writtenDate AS DATE), relatedExpense,cashed
 FROM crm.payablechecks
 
 -- vehicle_sizes
SET @now =  CURRENT_DATE();
TRUNCATE TABLE  Booker.vehicle_sizes;
INSERT INTO Booker.vehicle_sizes(created_at, updated_at, name)
 SELECT DISTINCT @now, @now, size 
 FROM crm.vehicles
WHERE size IS NOT NULL AND TRIM(size) <> '';

 -- brands
SET @now =  CURRENT_DATE();
TRUNCATE TABLE  Booker.brands;
INSERT INTO Booker.brands(created_at, updated_at, name)
 SELECT DISTINCT @now, @now, maker 
 FROM crm.vehicles
WHERE maker IS NOT NULL AND TRIM(maker) <> '';


-- vehicles
TRUNCATE TABLE Booker.vehicles;
 INSERT INTO Booker.vehicles(id,created_at,updated_at,name,size_id,brand_id,model,year,color,last_oil_change, miles_to_oil_change,current_miles,registration_experation_on,insurance_experation_on,
 daily_rate, weekly_rate, monthly_rate, is_active, 
 vin_number, licence_plate, purchase_cost)
 SELECT 
 vehicles_id,addDate,addDate,v.name,IFNULL(vs.id, 1) as size_id
 ,IFNULL(b.Id, 1) AS brand_id
 ,model,year,color,oilChange,oilChangeMillage,currentMillage,registrationExp,insuranceExp,dailyRate,weekleyRate,monthleyRate,active, VINnum, licensePlate,vehicleCost
 FROM crm.vehicles AS v
 LEFT JOIN Booker.vehicle_sizes AS vs ON vs.name = v.size
 LEFT JOIN Booker.brands AS b ON b.name = v.maker;
 

-- reservations

-- credits 

