<div class="lg:col-span-9 md:col-span-8">
    <div class="space-y-10">
        <div class="space-y-5">
            <!-- section:title -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                </div>
                <div class="font-black text-foreground">ویرایش پروفایل</div>
            </div>
            <!-- end section:title -->

            <!-- tabs container -->
            <div class="space-y-5" x-data="{ activeTab: 'tabOne'}">
                <!-- tabs:list-container -->
                <div class="relative overflow-x-auto">
                    <!-- tabs:list -->
                    <ul
                        class="inline-flex gap-2 bg-secondary border border-border rounded-full p-1">
                        <!-- tabs:list:item -->
                        <li>
                            <button type="button"
                                    class="flex items-center gap-x-2 w-full relative rounded-full py-2 px-4"
                                    x-bind:class="activeTab === 'tabOne' ? 'text-foreground bg-background' : 'text-muted'"
                                    x-on:click="activeTab = 'tabOne'">
                                <!-- active icon -->
                                <span x-show="activeTab === 'tabOne'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                             fill="currentColor" class="w-5 h-5">
                                                            <path
                                                                d="M16.7574 2.99677L9.29145 10.4627L9.29886 14.7098L13.537 14.7024L21 7.23941V19.9968C21 20.5491 20.5523 20.9968 20 20.9968H4C3.44772 20.9968 3 20.5491 3 19.9968V3.99677C3 3.44448 3.44772 2.99677 4 2.99677H16.7574ZM20.4853 2.09727L21.8995 3.51149L12.7071 12.7039L11.2954 12.7063L11.2929 11.2897L20.4853 2.09727Z">
                                                            </path>
                                                        </svg>
                                                    </span><!-- end active icon -->

                                <!-- inactive icon -->
                                <span x-show="activeTab !== 'tabOne'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                             fill="currentColor" class="w-5 h-5">
                                                            <path
                                                                d="M16.7574 2.99677L14.7574 4.99677H5V18.9968H19V9.23941L21 7.23941V19.9968C21 20.5491 20.5523 20.9968 20 20.9968H4C3.44772 20.9968 3 20.5491 3 19.9968V3.99677C3 3.44448 3.44772 2.99677 4 2.99677H16.7574ZM20.4853 2.09727L21.8995 3.51149L12.7071 12.7039L11.2954 12.7063L11.2929 11.2897L20.4853 2.09727Z">
                                                            </path>
                                                        </svg>
                                                    </span><!-- end inactive icon -->

                                <span class="font-semibold text-sm whitespace-nowrap">اطلاعات
                                                        حساب</span>
                            </button>
                        </li><!-- end tabs:list:item -->

                        <!-- tabs:list:item -->
                        <li>
                            <button type="button"
                                    class="flex items-center gap-x-2 w-full relative rounded-full py-2 px-4"
                                    x-bind:class="activeTab === 'tabTwo' ? 'text-foreground bg-background' : 'text-muted'"
                                    x-on:click="activeTab = 'tabTwo'">
                                <!-- active icon -->
                                <span x-show="activeTab === 'tabTwo'">
                                    <!-- Profile (user) icon - active -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M12 12c2.7614 0 5-2.2386 5-5s-2.2386-5-5-5-5 2.2386-5 5 2.2386 5 5 5zm0 2c-3.3137 0-10 1.6569-10 5v3h20v-3c0-3.3431-6.6863-5-10-5z"/>
                                    </svg>
                                </span><!-- end active icon -->

                                <!-- inactive icon -->
                                <span x-show="activeTab !== 'tabTwo'">
                                    <!-- Profile (user) icon - inactive -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M12 12c2.7614 0 5-2.2386 5-5s-2.2386-5-5-5-5 2.2386-5 5 2.2386 5 5 5zm0 2c-3.3137 0-10 1.6569-10 5v3h20v-3c0-3.3431-6.6863-5-10-5z" opacity="0.5"/>
                                    </svg>
                                </span><!-- end inactive icon -->

                                <span class="font-semibold text-sm whitespace-nowrap">مدارک کاربر</span>
                            </button>
                        </li><!-- end tabs:list:item -->

                        <!-- tabs:list:item -->
                        <li>
                            <button type="button"
                                    class="flex items-center gap-x-2 w-full relative rounded-full py-2 px-4"
                                    x-bind:class="activeTab === 'tabThree' ? 'text-foreground bg-background' : 'text-muted'"
                                    x-on:click="activeTab = 'tabThree'">
                                <!-- active icon -->
                                <span x-show="activeTab === 'tabThree'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                             fill="currentColor" class="w-5 h-5">
                                                            <path
                                                                d="M17 14H12.6586C11.8349 16.3304 9.61244 18 7 18C3.68629 18 1 15.3137 1 12C1 8.68629 3.68629 6 7 6C9.61244 6 11.8349 7.66962 12.6586 10H23V14H21V18H17V14ZM7 14C8.10457 14 9 13.1046 9 12C9 10.8954 8.10457 10 7 10C5.89543 10 5 10.8954 5 12C5 13.1046 5.89543 14 7 14Z">
                                                            </path>
                                                        </svg>
                                                    </span><!-- end active icon -->

                                <!-- inactive icon -->
                                <span x-show="activeTab !== 'tabThree'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                             fill="currentColor" class="w-5 h-5">
                                                            <path
                                                                d="M12.917 13C12.441 15.8377 9.973 18 7 18C3.68629 18 1 15.3137 1 12C1 8.68629 3.68629 6 7 6C9.973 6 12.441 8.16229 12.917 11H23V13H21V17H19V13H17V17H15V13H12.917ZM7 16C9.20914 16 11 14.2091 11 12C11 9.79086 9.20914 8 7 8C4.79086 8 3 9.79086 3 12C3 14.2091 4.79086 16 7 16Z">
                                                            </path>
                                                        </svg>
                                                    </span><!-- end inactive icon -->

                                <span class="font-semibold text-sm whitespace-nowrap">رمز
                                                        عبور</span>
                            </button>
                        </li><!-- end tabs:list:item -->

                        <!-- tabs:list:item -->
                        <li>
                            <button type="button"
                                    class="flex items-center gap-x-2 w-full relative rounded-full py-2 px-4"
                                    x-bind:class="activeTab === 'tabFour' ? 'text-foreground bg-background' : 'text-muted'"
                                    x-on:click="activeTab = 'tabFour'">
                                <!-- active icon -->
                                <span x-show="activeTab === 'tabFour'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                             fill="currentColor" class="w-5 h-5">
                                                            <path
                                                                d="M12 2C16.9706 2 21 6.04348 21 11.0314V20H3V11.0314C3 6.04348 7.02944 2 12 2ZM9.5 21H14.5C14.5 22.3807 13.3807 23.5 12 23.5C10.6193 23.5 9.5 22.3807 9.5 21Z">
                                                            </path>
                                                        </svg>
                                                    </span><!-- end active icon -->

                                <!-- inactive icon -->
                                <span x-show="activeTab !== 'tabFour'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                             fill="currentColor" class="w-5 h-5">
                                                            <path
                                                                d="M5 18H19V11.0314C19 7.14806 15.866 4 12 4C8.13401 4 5 7.14806 5 11.0314V18ZM12 2C16.9706 2 21 6.04348 21 11.0314V20H3V11.0314C3 6.04348 7.02944 2 12 2ZM9.5 21H14.5C14.5 22.3807 13.3807 23.5 12 23.5C10.6193 23.5 9.5 22.3807 9.5 21Z">
                                                            </path>
                                                        </svg>
                                                    </span><!-- end inactive icon -->

                                <span class="font-semibold text-sm whitespace-nowrap">اطلاع
                                                        رسانی</span>
                            </button>
                        </li><!-- end tabs:list:item -->
                    </ul><!-- end tabs:list -->
                </div><!-- end tabs:list-container -->
                <!-- tabs:contents -->
                <div class="bg-secondary rounded-3xl p-5">

                    <!-- tabs:contents:tabOne -->
                    <livewire:client.items.profile.tab-one-profile-form />
                    <!-- end tabs:contents:tabOne -->



                    <!-- tabs:contents:tabTwo -->
                    <livewire:client.items.profile.tab-two-profile-form />
                    <!-- end tabs:contents:tabTwo -->



                    <!-- tabs:contents:tabTwo -->
                    <livewire:client.items.profile.tab-tree-profile-form />
                    <!-- end tabs:contents:tabTwo -->


                    <!-- tabs:contents:tabTwo -->
                    <div class="space-y-5" x-show="activeTab === 'tabFour'">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1">
                                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                <div class="w-2 h-2 bg-foreground rounded-full"></div>
                            </div>
                            <div class="font-black text-foreground">اطلاع رسانی</div>
                        </div>

                        <form action="#" class="space-y-5">
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-right">
                                    <thead
                                        class="text-xs text-muted uppercase border-b border-border">
                                    <tr>
                                        <th class="p-5">عملیات</th>
                                        <th class="p-5">پیامک</th>
                                        <th class="p-5">ایمیل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="p-5">
                                            <div class="font-medium text-sm text-muted">
                                                تایید دیدگاه
                                            </div>
                                        </td>
                                        <td class="p-5">
                                            <input type="checkbox"
                                                   class="form-checkbox w-6 h-6 !ring-0 !ring-offset-0 bg-border border-0 rounded-lg cursor-pointer"
                                                   checked/>
                                        </td>
                                        <td class="p-5">
                                            <input type="checkbox"
                                                   class="form-checkbox w-6 h-6 !ring-0 !ring-offset-0 bg-border border-0 rounded-lg cursor-pointer"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-5">
                                            <div class="font-medium text-sm text-muted">
                                                بروزرسانی دوره
                                            </div>
                                        </td>
                                        <td class="p-5">
                                            <input type="checkbox"
                                                   class="form-checkbox w-6 h-6 !ring-0 !ring-offset-0 bg-border border-0 rounded-lg cursor-pointer"
                                                   checked/>
                                        </td>
                                        <td class="p-5">
                                            <input type="checkbox"
                                                   class="form-checkbox w-6 h-6 !ring-0 !ring-offset-0 bg-border border-0 rounded-lg cursor-pointer"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-5">
                                            <div class="font-medium text-sm text-muted">
                                                ورود به سایت
                                            </div>
                                        </td>
                                        <td class="p-5">
                                            <input type="checkbox"
                                                   class="form-checkbox w-6 h-6 !ring-0 !ring-offset-0 bg-border border-0 rounded-lg cursor-pointer"/>
                                        </td>
                                        <td class="p-5">
                                            <input type="checkbox"
                                                   class="form-checkbox w-6 h-6 !ring-0 !ring-offset-0 bg-border border-0 rounded-lg cursor-pointer"
                                                   checked/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-5">
                                            <div class="font-medium text-sm text-muted">
                                                خرید دوره
                                            </div>
                                        </td>
                                        <td class="p-5">
                                            <input type="checkbox"
                                                   class="form-checkbox w-6 h-6 !ring-0 !ring-offset-0 bg-border border-0 rounded-lg cursor-pointer"/>
                                        </td>
                                        <td class="p-5">
                                            <input type="checkbox"
                                                   class="form-checkbox w-6 h-6 !ring-0 !ring-offset-0 bg-border border-0 rounded-lg cursor-pointer"
                                                   checked/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-end gap-5">
                                <button type="submit"
                                        class="h-11 inline-flex items-center justify-center gap-3 bg-primary rounded-full text-white px-4 mr-auto">
                                    <span class="font-semibold text-sm">بروزرسانی</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                              d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div><!-- end tabs:contents:tabTwo -->
                </div><!-- end tabs:contents -->
            </div><!-- end tabs container -->
        </div>
    </div>
</div>
