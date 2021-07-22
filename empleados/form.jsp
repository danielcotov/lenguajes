<%@ page language="java" contentType="text/html; charset=UTF-8"
         pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>
            <c:if test="${employee != null}">
                Gualmarsh / Edit
            </c:if>
            <c:if test="${employee == null}">
                Gualmarsh / Add
            </c:if>   
        </title>
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <link rel="stylesheet" href="style">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css-font">
    </head>
    <body>
    <body>
        <div class="wrapper d-flex align-items-stretch" style="font-family: 'Bogle';">
            <nav id="sidebar">
                <div class="custom-menu">
                </div>
                <div class="p-4">
                    <img src="logo" width="275" height="65" alt="Logo"/> 
                    <ul class="list-unstyled components mb-5">
                        <li>
                            <a href="<%=request.getContextPath()%>/home"><span class="fa fa-home mr-3"></span> Home</a>
                        </li>
                        <li>
                            <a href="<%=request.getContextPath()%>/charts"><span class="fa fa-bar-chart mr-3"></span> Charts</a>
                        </li>
                        <li class="active">
                            <a href="<%=request.getContextPath()%>/employees"><span class="fa fa-users mr-3"></span> Employees</a>
                        </li>
                        <li>
                            <a href="<%=request.getContextPath()%>/customers"><span class="fa fa-user-o mr-3"></span> Customers</a>
                        </li>
                        <li>
                            <a href="<%=request.getContextPath()%>/products"><span class="fa fa-shopping-cart mr-3"></span> Products</a>
                        </li>
                        <li>
                            <a href="<%=request.getContextPath()%>/sale"><span class="fa fa-usd mr-3"></span> New Sale</a>
                        </li>
                        <li>
                            <a href="<%=request.getContextPath()%>/report-list"><span class="fa fa-file-text mr-3"></span> Reports</a>
                        </li>
                    </ul>
                    <div class="footer">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>document.write(new Date().getFullYear());</script> All rights reserved | 
                            <i class="icon-heart" aria-hidden="true"></i>GADAFA <a
                                href="https://fidelitas.com" target="_blank"></a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </nav>
                        
            <!-- Contenido Principal  -->
            <div id="content" class="container col-md-5 pt-5">
                <div class="card">
                    <div class="card-body">
                        <c:if test="${employee != null}">
                            <form action="employee-update" method="post">
                            </c:if>
                            <c:if test="${employee == null}">
                                <form id="employeeForm" action="employee-insert" method="post">
                                </c:if>
                                <caption>
                                    <h2 style="font-family: 'Bogle'; font-size: 40px;">
                                        <c:if test="${employee != null}">
                                            Edit Employee
                                        </c:if>
                                        <c:if test="${employee == null}">
                                            Add Employee
                                        </c:if>
                                    </h2>
                                    <hr style="height: 5px; background-color: #007DC6;">
                                </caption>
                                <c:if test="${employee != null}">
                                    <input type="hidden" name="id" value="<c:out value='${employee.id}' />" />
                                </c:if>
                                <fieldset class="form-group">
                                    <label>Name</label>
                                    <input type="text"
                                           value="<c:out value='${employee.name}' />" class="form-control"
                                           name="name" required="required">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label>DNI</label>
                                    <input type="text"
                                           value="<c:out value='${employee.dni}' />" class="form-control"
                                           name="dni" required="required">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label>Username</label>
                                    <input type="text"
                                           value="<c:out value='${employee.username}' />" class="form-control"
                                           name="username1" required="required">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label>Password</label>
                                    <input type="password"
                                           value="<c:out value='${employee.password}' />" class="form-control"
                                           name="password1" required="required">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label>Email</label> 
                                    <input type="text"
                                           value="<c:out value='${employee.email}' />" class="form-control"
                                           name="email">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label>Phone</label>
                                    <input type="text"
                                           value="<c:out value='${employee.phone}' />" class="form-control"
                                           name="phone" required="required">
                                </fieldset>
                                <fieldset class="form-group">
                                    <label>Access Level</label> 
                                    <input type="text"
                                           value="<c:out value='${employee.access_level}' />" class="form-control"
                                           name="access_level" required="required">
                                </fieldset>
                                <button type="submit" id="submitEmployee" class="btn btn-success">Save</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
