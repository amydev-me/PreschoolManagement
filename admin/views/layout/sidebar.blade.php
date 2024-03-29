<aside class="left-panel">
    <div class="logo">
        <a href="#" class="logo-expanded" v-cloak>
            <img v-if="info.logo!='null'&&info.logo!=null" style="width: 24px;height: 24px;" :src="getImage(info.logo)" >
            <span class="nav-label">@{{ info.title }}</span>
        </a>
    </div>
    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">
            <li class="@yield('dashboard')"><a href="{{route('index')}}"><i class="ion-home"></i> <span class="nav-label">Dashboard</span></a></li>
            <li class="@yield('user')"><a href="{{route('admin.user.index')}}"><i class="ion-person-stalker"></i> <span class="nav-label">Manage Users</span></a></li>
            <li class="has-submenu @yield('setup')"><a href="#"><i class="ion-settings"></i> <span class="nav-label">Settings</span></a>
                <ul class="list-unstyled">
                    <li class="@yield('setting')"><a href="{{route('admin.info.index')}}">Informations</a></li>
                    <li class="@yield('academic')"><a href="{{route('admin.academic-year.index')}}">Year</a></li>
                    <li class="@yield('category')"><a href="{{route('admin.category.index')}}">Grade Category</a></li>
                    <li class="@yield('term')"><a href="{{route('admin.term.index')}}">Term</a></li>
                    <li class="@yield('grade')"><a href="{{route('admin.grade.index')}}">Grade</a></li>
                    <li class="@yield('subject')"><a href="{{route('admin.subject.index')}}">Subject</a></li>
                    <li class="@yield('fee')"><a href="{{route('admin.feetype.index')}}">Fee Types</a></li>
                    <li class="@yield('assign_teacher')"><a href="{{route('admin.assign_teacher.index')}}">Grade Teacher Allocation</a></li>
                </ul>
            </li>
            <li class="has-submenu @yield('teacher_setup')"><a href="#"><i class="ion-person-stalker"></i> <span class="nav-label">Teachers</span></a>
                <ul class="list-unstyled">
                    <li class="@yield('teacher-list')"><a href="{{route('admin.teacher.index')}}">Teacher List</a></li>
                    <li class="@yield('add-teacher')"><a href="{{route('admin.teacher.create')}}">Add New Teacher</a></li>
                </ul>
            </li>
            <li class="has-submenu @yield('student_setup')"><a href="#"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Students</span></a>
                <ul class="list-unstyled">
                    <li class="@yield('student-list')"><a href="{{route('admin.student.index')}}">Student List</a></li>
                    <li class="@yield('add-student')"><a href="{{route('admin.student.create')}}">Add New Student</a></li>
                </ul>
            </li>
            {{--<li class="@yield('teacher')"><a href="{{route('admin.teacher.index')}}"><i class="ion-person-stalker"></i> <span class="nav-label">Teachers</span></a></li>--}}
            {{--<li class="@yield('student')"><a href="{{route('admin.student.index')}}"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Students</span></a></li>--}}
{{--            <li class="@yield('guardian')"><a href="{{route('admin.guardian.index')}}"><i class="ion-person-stalker"></i> <span class="nav-label">Guardians</span></a></li>--}}
            {{--<li class="@yield('payment')"><a href="{{route('admin.payment.index')}}"><i class="fa   fa-newspaper-o"></i> <span class="nav-label">Invoice</span></a></li>--}}
            <li class="has-submenu @yield('payment_setup')"><a href="#"><i class="fa   fa-newspaper-o"></i> <span class="nav-label">Invoice</span></a>
                <ul class="list-unstyled">
                    <li class="@yield('payment-list')"><a href="{{route('admin.payment.index')}}">Invoice List</a></li>
                    <li class="@yield('add-payment')"><a href="{{route('admin.payment.create')}}">Create Invoice</a></li>
                </ul>
            </li>
            <li class="@yield('attendance')"><a href="{{route('admin.attendance.index')}}"><i class="fa  fa-outdent"></i> <span class="nav-label">Attendance Register</span></a></li>


        </ul>
    </nav>
</aside>