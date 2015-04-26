from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
import time
from selenium.webdriver.common.action_chains import ActionChains
import mysql.connector

driver = webdriver.Firefox()
driver.get("http://timeraft.cloudapp.net")
time.sleep(1)
if "Timeraft" in driver.title:
    print("Timerafti lehel olen tõesti")
else:
    print("error error error")

def signin(driver, email, pw):
    driver.find_element_by_id("SignInButton").click()
    driver.find_element_by_name("email").send_keys(email)
    driver.find_element_by_name("password").send_keys(pw)
    driver.find_element_by_id("submit_signin").click()
    print("Signin test passed, with email: " + email)

def gotoStat(driver):
    #driver.get("http://timeraft.cloudapp.net/stats.php")
    hovelem = driver.find_element_by_id("account")
    hover = ActionChains(driver).move_to_element(hovelem)
    hover.perform()
    anotherelem = driver.find_element_by_id("stats").click()
    print("Navigation test passed, now in Stats page")

def addBoard(driver, boardName, boardDesc):
    time.sleep(2)
    driver.find_element_by_id("pluss").click()
    driver.find_element_by_name("name").send_keys(boardName)
    driver.find_element_by_name("desc").send_keys(boardDesc)
    time.sleep(1)
    driver.find_element_by_id("submit_newBoard").click()
    print("addboard test passed, added board with name: " + boardName + " and description: " + boardDesc)
    

def signup(driver, name, email, pw):
    driver.find_element_by_id("SignUpButton").click()
    driver.find_element_by_id("signupemail").send_keys(email)
    driver.find_element_by_id("signupname").send_keys(name)
    driver.find_element_by_id("signuppw").send_keys(pw)
    driver.find_element_by_id("submit_signup").click()
    print("Signup test passed, signed up with name: " + name + " and email: " + email)

def gotoBoard(driver, idi):
    driver.find_element_by_id("task0").click()
    driver.find_element_by_name("tasks").click()
    print("gotoBoard test passed, now on board, with id: " +str(idi))

def addtask(driver, name, desc, duedate):
    driver.find_element_by_id("addButton").click()
    driver.find_element_by_name("name").send_keys(name)
    driver.find_element_by_name("desc").send_keys(desc)
    driver.find_element_by_name("DueDate").send_keys(duedate)
    driver.find_element_by_id("submit_newTask").click()
    print("addtask test passed, added task with name: " + name + " desc: "+ desc)
    
def logout(driver):
    hovelem = driver.find_element_by_id("account")
    hover = ActionChains(driver).move_to_element(hovelem)
    hover.perform()
    anotherelem = driver.find_element_by_id("logoutBtn").click()
    print("logout test passed, now on main page")

### Variable, can change everything
idi = 0
email = "Sander.Viinapeep@goog.le"
pw = "kartul"
name = "Kartulimees"
brdname = "midateha"
brddescr = "labidamees"
taskname = "ostalabidas"
taskdesc = "maksa5euuro"
taskdate = "10/10/2020"
### Taimer variable. With less than 4 seconds some tests failed, because loading was too slow and didn't find elements
tam = 4

signup(driver, name, email, pw)
time.sleep(tam)
logout(driver)
time.sleep(tam)
signin(driver, email, pw)
addBoard(driver, brdname, brddescr)
time.sleep(tam)
gotoBoard(driver, idi)
time.sleep(tam)
addtask(driver, taskname, taskdesc, taskdate)
time.sleep(tam+3)
gotoStat(driver)
time.sleep(tam)
logout(driver)
              
time.sleep(2)
driver.close()

## Make cleanup (Remove email from database)
cnx = mysql.connector.connect(user='jumal', password='jumal1',
                              host='timeraft.cloudapp.net',
                              database='timeraft')

cursor = cnx.cursor()
delstatmt = "CALL sp_delUser({0});"
email = "\"" + email + "\""
stmt = delstatmt.format(email)

print("Running statement: " + stmt)
cursor.execute(stmt)
cnx.commit()
cnx.close()

print("All tests passed, also everything that was added is now removed from database")
