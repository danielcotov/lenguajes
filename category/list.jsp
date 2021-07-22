<%@ page language="java" contentType="text/html; charset=UTF-8"
         pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Gualmarsh / Category List</title>
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style">
        <link rel="stylesheet" href="css-font">
    </head>
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
                        <li>
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
            <div id="content" class="p-4 p-md-5 pt-5">
                <div class="row">
                    <div class="container">
                        <h3 class="text-center" style="font-family: 'Bogle'; font-size: 40px;">Category List</h3>
                        <hr style="height: 5px; background-color: #007DC6;">
                        <div class="container text-left">

                            <a href="<%=request.getContextPath()%>/category-new" class="btn btn-success">Add Category</a>
                        </div>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                            </thead>
                            <tbody>
                                <c:forEach var="category" items="${listCategory}">
                                    <tr>
                                        <td><c:out value="${category.id}" /></td>
                                        <td><c:out value="${category.name}" /></td>

                                        <td><a href="category-edit?id=<c:out value='${category.id}' />">Edit</a>
                                            &nbsp;&nbsp;&nbsp;&nbsp; <a
                                                href="category-delete?id=<c:out value='${category.id}' />">Delete</a></td>
                                    </tr>
                                </c:forEach>
                            </tbody>
                        </table>
                    </div>
                </div>
                </body>
                </html>
