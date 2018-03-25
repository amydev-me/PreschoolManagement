<aside class="left-panel">
    <div class="logo">
        <a href="#" class="logo-expanded" v-cloak>
            <img style="width: 24px;height: 24px;" :src="getImage(info.logo)" v-if="info.logo!='null'">
            <span class="nav-label">@{{ info.title }}</span>
        </a>
    </div>
    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">
            <li class="@yield('dashboard')"><a href="{{route('admin.dashboard.index')}}"><i class="ion-home"></i> <span class="nav-label">Dashboard</span></a></li>
            <li class="has-submenu @yield('setup')"><a href="#"><i class="ion-settings"></i> <span class="nav-label">Settings</span></a>
                <ul class="list-unstyled">
                    <li class="@yield('setting')"><a href="{{route('admin.info.index')}}">Informations</a></li>
                    <li class="@yield('academic')"><a href="{{route('admin.academic-year.index')}}">Year</a></li>
                    <li class="@yield('category')"><a href="{{route('admin.category.index')}}">Grade Category</a></li>
                    <li class="@yield('fee')"><a href="{{route('admin.feetype.index')}}">Fee Types</a></li>
                    {{--<li class="@yield('class')"><a href="{{route('admin.class.index')}}">Class</a></li>--}}
                    <li class="@yield('grade')"><a href="{{route('admin.grade.index')}}">Grade</a></li>
                    <li class="@yield('subject')"><a href="{{route('admin.subject.index')}}">Subject</a></li>
                    {{--<li class="@yield('manage')"><a href="{{route('admin.manage.index')}}">Grade Teacher Allocation</a></li>--}}

                </ul>
            </li>
            {{--<li class="@yield('user')"><a href="{{route('admin.user.index')}}"><i class="ion-person-stalker"></i> <span class="nav-label">Manage Users</span></a></li>--}}
            {{--<li class="@yield('teacher')"><a href="{{route('admin.teacher.index')}}"><i class="ion-person-stalker"></i> <span class="nav-label">Teachers</span></a></li>--}}
            {{--<li class="@yield('student')"><a href="{{route('admin.student.index')}}"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Students</span></a></li>--}}
            {{--<li class="@yield('guardian')"><a href="{{route('admin.guardian.index')}}"><i class="ion-person-stalker"></i> <span class="nav-label">Guardians</span></a></li>--}}
            {{--<li class="@yield('payment')"><a href="{{route('admin.payment.index')}}"><i class="fa   fa-newspaper-o"></i> <span class="nav-label">Invoice</span></a></li>--}}
            {{--<li class="@yield('attendance')"><a href="{{route('admin.student.attendance.index')}}"><i class="fa  fa-outdent"></i> <span class="nav-label">Attendance</span></a></li>--}}
        </ul>
    </nav>
</aside>