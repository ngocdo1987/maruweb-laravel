<table>
    <thead>
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Member registration datetime') }}</th>
            <th>{{ __('Last settlement confirmation date') }}</th>
            <th>{{ __('Last deposit report date') }}</th>
            <th>{{ __('Last login datetime') }}</th>
            <th>{{ __('Last update date') }}</th>
            <th>{{ __('Individual-Name') }}</th>
            <th>{{ __('Individual-Kana') }}</th>
            <th>{{ __('Personal-Home Address-Zip Code') }}</th>
            <th> {{__ ('Individual-Home Address-Prefecture') }} </th>
            <th> {{__ ('Individual-Home Address-City / Address') }} </th>
            <th> {{__ ('Individual-Home Address-Building Name / Room No.') }}</th>
            <th> {{__ ('Individual-Gender')}} </th>
            <th> {{__ ('Individual-Date of Birth')}} </th>
            <th> {{__ ('Personal-email address (login ID)')}} </th>
            <th>{{ __('Individual-TEL') }}</th>
            <th>{{ __('Individual-FAX') }}</th>
            <th>{{ __('Individual-Affiliation (company, school, etc.)') }}</th>
            <th>{{ __('Individual-Affiliation (Frigana)') }}</th>
            <th>{{ __('Individual-Department / Job Title') }}</th>
            <th>{{ __('Individual-Affiliation Address-Zip Code') }}</th>
            <th>{{ __('Individual-Affiliation Address-Prefecture') }}</th>
            <th>{{ __('Individual-Affiliation Address-City / Street') }}</th>
            <th>{{ __('Individual-Affiliation Address-Building Name / Room') }}</th>
            <th>{{ __('Personal-Affiliation Address-Email Address') }}</th>
            <th>{{ __('Individual-Affiliation Address-TEL') }}</th>
            <th>{{ __('Individual-Affiliation Address-FAX') }}</th>
            <th>{{ __('Personal-mail address') }}</th>
            <th>{{ __('Corporate-Corporate (group) name') }}</th>
            <th>{{ __('Corporation-Corporate (group) name Frigana') }}</th>
            <th>{{ __('Corporate-Headquarters (Headquarters) Address-Zip Code') }}</th>
            <th>{{ __('Corporation-Headquarters (Headquarters) Address-Prefectures') }}</th>
            <th>{{ __('Corporation-Headquarters (Headquarters) Address-City / Street') }}</th>
            <th>{{ __('Corporation-Headquarters (Headquarters) Address-Building name / Room') }}</th>
            <th>{{ __('Corporate-Association Notification Representative Name') }}</th>
            <th>{{ __('Corporate-Association Notification Representative Name (Kana)') }}</th>
            <th>{{ __('Corporation-Department / Job Title') }}</th>
            <th>{{ __('Corporate-Representative Email Address (Login ID)') }}</th>
            <th>{{ __('Corporate-Association Notification Representative Representative Name') }}</th>
            <th>{{ __('Corporation-Association Notification Representative Representative Name (Kana)') }}</th>
            <th>{{ __('Corporation-Agent department / position') }}</th>
            <th>{{ __('Corporate-agent email address') }}</th>
            <th>{{ __('Corporate-Mail Address Address-Zip Code') }}</th>
            <th>{{ __('Corporate-Mail Address Address-Prefecture') }}</th>
            <th>{{ __('Corporation-Mail address address-City / street address') }}</th>
            <th>{{ __('Corporate-Mail Address Address-Building Name / Room') }}</th>
            <th>{{ __('Corporate-Address') }}</th>
            <th>{{ __('Corporate-Contact Person') }}</th>
            <th>{{ __('Corporate-Contact person (Kana)') }}</th>
            <th>{{ __('Corporate-Contact Department / Job Title') }}</th>
            <th>{{ __('Corporate-Contact Email Address') }}</th>
            <th>{{ __('Corporate-TEL') }}</th>
            <th>{{ __('Corporate-FAX') }}</th>
            <th>{{ __('Corporate-Corporate URL') }}</th>
            <th>{{ __('Corporation-Number of applications') }}</th>
            <th>{{ __('Industry') }}</th>
            <th>{{ __('Payment method') }}</th>
            <th>{{ __('Refining Architectural Rating') }}</th>
            <th>{{ __('client') }}</th>
            <th>{{ __('e-mail magazine') }}</th>
            <th>{{ __('Delivery address1') }}1</th>
            <th>{{ __('Delivery address1') }}2</th>
            <th>{{ __('Delivery address1') }}3</th>
            <th>{{ __('Delivery address1') }}4</th>
            <th>{{ __('Delivery address1') }}5</th>
            <th>{{ __('Delivery address1') }}6</th>
            <th>{{ __('Delivery address1') }}7</th>
            <th>{{ __('Delivery address1') }}8</th>
            <th>{{ __('Delivery address1') }}9</th>
            <th>{{ __('Delivery address1') }}10</th>
            <th>{{ __('Lecture / Study Session') }}</th>
            <th>{{ __('Disassembly / completion tour') }}</th>
            <th>{{ __('Other') }}</th>
            <th>{{ __('Administrator notes') }}</th>
        </tr>
    </thead>
    <tbody>
    @php 
        $rememberUserId = 0; 
    @endphp 
    @foreach($users as $user)
        @if ($user->id != $rememberUserId)
            @php 
                $checkUer = false;
                if (in_array($user->user_type, [0, 1, 3])){
                    $checkUer = true;
                }else{
                    $checkUer = false;
                }
            @endphp
            <tr>
                <td>USE{{ str_pad($user->id, 7, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    @if($user->user_type != 3)
                        {{ $user->settlement_confirmation_date }} 
                        @if ($user->settlement_confirmation_flag == 1)
                            （取消済み）
                        @endif
                    @endif
                </td>
                <td>
                    @if($user->user_type != 3)
                        {{ $user->last_deposit_report_date }}
                    @endif
                </td>
                <td>
                    {{ $user->last_login_date }}
                </td>
                <td>
                    {{ $user->updated_at }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->fname. ' '.$user->lname :'' }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->fname_kana. ' '.$user->lname_kana : '' }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->home_postcode : '' }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->home_prefecture : '' }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->home_city : '' }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->home_address : '' }}
                </td>
                <td>
                    @if (in_array($user->user_type, [0, 1, 3]))
                    @else 
                        {{ $user->gender == 0 ? '男性' : '女性' }}
                    @endif
                </td>
                <td>
                    {{ $checkUer == false ? $user->birthday : ''}}
                </td>
                <td>
                    {{ $checkUer == false ? $user->email :'' }}
                </td>
                <td>
                    @if (in_array($user->user_type, [0, 1, 3]))
                    @else 
                        {{ stringExportCsv($user->tel) }}
                    @endif
                </td>
                <td>
                    @if (in_array($user->user_type, [0, 1, 3]))
                    @else 
                        {{ stringExportCsv($user->fax) }}
                    @endif
                </td>
                <td>
                    {{ $checkUer == false ? $user->company_name :'' }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->company_name_kana :'' }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->department :'' }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->company_postcode :'' }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->company_prefecture :'' }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->company_city : '' }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->company_address : '' }}
                </td>
                <td>
                    {{ $checkUer == false ? $user->company_email : '' }}
                </td>
                <td>
                    {{ $checkUer == false ? stringExportCsv($user->company_tel) : '' }}
                </td>
                <td>
                    {{ $checkUer == false ? stringExportCsv($user->company_fax) : '' }}
                </td>
                <td>
                    @if (in_array($user->user_type, [0, 1, 3]))
                    @else 
                        {{ $user->choose_mailing_address == 0 ? '自宅' : '所属先' }}
                    @endif
                </td>
                {{-- end Individual  --}}
                <td>
                    {{ $checkUer == true ? $user->corporation_name : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->corporation_name_kana : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->head_office_postcode : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->head_office_prefecture : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->head_office_city : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->head_office_address : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->association_notification_representative_fname. ' '.$user->association_notification_representative_lname : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->association_notification_representative_fname_kana. ' '.$user->association_notification_representative_lname_kana : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->department : '' }} 
                </td>
                <td>
                    {{ $checkUer == true ? $user->representative_email : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->association_notification_representative_2nd_fname. ' '.$user->association_notification_representative_2nd_lname : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->association_notification_representative_2nd_fname_kana. ' '.$user->association_notification_representative_2nd_lname_kana : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->department_2nd : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->representative_email_2nd : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->mailing_postcode : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->mailing_prefecture : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->mailing_city : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->mailing_address : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->receive_name : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->contact_fname .' '. $user->contact_lname : '' }}
                </td>
                 <td>
                    {{ $checkUer == true ? $user->contact_fname_kana .' '. $user->contact_lname_kana : ''  }}
                </td>
                 <td>
                    {{ $checkUer == true ? $user->contact_department : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? $user->contact_email : '' }}
                </td>
                <td>
                    @if (in_array($user->user_type, [0, 1, 3]))
                        {{ stringExportCsv($user->tel) }}
                    @else 
                    @endif
                </td>
                <td>
                    @if (in_array($user->user_type, [0, 1, 3]))
                        {{ stringExportCsv($user->fax) }}
                    @else 
                    @endif
                </td>
                <td>
                    {{ $checkUer == true ? $user->corporate_url : '' }}
                </td>
                <td>
                    {{ $checkUer == true ? ($user->number_of_applications != 0 ? $user->number_of_applications : '') : '' }}
                </td>
                <td>
                    {{ isset($industryConfig[$user->industry]) ? __($industryConfig[$user->industry]) : '' }}
                </td>
                <td>
                    {{ isset($paymentMethodConfig[$user->payment_method]) ? __($paymentMethodConfig[$user->payment_method]) : '' }}
                </td>
                <td> 
                    @php 
                    $refiningBuildingRating = explode("-", $user->refining_building_rating);
                    $refiningBuildingRatingYear = isset($refiningBuildingRating[0]) ? $refiningBuildingRating[0] : '';
                    $refiningBuildingRatingMonth = isset($refiningBuildingRating[1]) ? $refiningBuildingRating[1] : '';
                    $year = $refiningBuildingRatingYear ? $refiningBuildingRatingYear .'年' : '';
                    $month = $refiningBuildingRatingMonth ? $refiningBuildingRatingMonth .'月' : '';
                    @endphp
                    {{ $year.$month }}
                </td>
                <td>
                    {{ isset($clientConfig[$user->client]) ? __($clientConfig[$user->client]) : '' }}
                </td>
                <td>
                    {{ $user->email_magazine == 1 ? '有' :'無'  }}
                </td>
                @php 
                    $email_delivery = json_decode($user->email_delivery_address);
                @endphp
                <td>
                    {{ isset($email_delivery->delivery_address_1) ? $email_delivery->delivery_address_1 :'' }}
                </td>
                <td>
                    {{ isset($email_delivery->delivery_address_2) ? $email_delivery->delivery_address_2 :'' }}

                </td>
                <td>
                    {{ isset($email_delivery->delivery_address_3) ? $email_delivery->delivery_address_3 :'' }}
                </td>
                <td>
                    {{ isset($email_delivery->delivery_address_4) ? $email_delivery->delivery_address_4 :'' }}
                </td>
                <td>
                    {{ isset($email_delivery->delivery_address_5) ? $email_delivery->delivery_address_5 :'' }}
                </td>
                <td>
                    {{ isset($email_delivery->delivery_address_6) ? $email_delivery->delivery_address_6 :'' }}
                </td>
                <td>
                    {{ isset($email_delivery->delivery_address_7) ? $email_delivery->delivery_address_7 :'' }}
                </td>
                <td>
                    {{ isset($email_delivery->delivery_address_8) ? $email_delivery->delivery_address_8 :'' }}
                </td>
                <td>
                    {{ isset($email_delivery->delivery_address_9) ? $email_delivery->delivery_address_9 :'' }}
                </td>
                <td>
                    {{ isset($email_delivery->delivery_address_10) ? $email_delivery->delivery_address_10 :'' }}
                </td>
                <td> 
                    @php 
                        $a = 0 ;
                        $b = 0 ;
                        $c = 0 ;
                        $rs1 = "";
                        $rs2 = "";
                        $rs3 = "";
                    @endphp 
                    @if($eventTypeConfig)
                        @foreach ($eventTypeConfig as $key1 => $item1) 
                            @if(isset($item1['user_id']) && $item1['user_id'] == $user->id && $item1['event_type'] == 0)
                                <?php  
                                    $a++ ;
                                    $rs1 .= $a > 1 ? '/ ' : '';
                                    $rs1 .= $item1['joined_date'];
                                ?> 
                            @endif
                        @endforeach
                        {{ stringExportCsv($rs1) }}
                    @endif
                </td>
                <td> 
                    @if($eventTypeConfig)
                        @foreach ($eventTypeConfig as $key2 => $item2) 
                            @if(isset($item2['user_id']) && $item2['user_id'] ==  $user->id && $item2['event_type'] == 1)
                            <?php  
                                $b++ ;
                                $rs2 .= $b > 1 ? '/ ' : '';
                                $rs2 .= $item2['joined_date'];
                            ?> 
                            @endif
                        @endforeach
                        {{ stringExportCsv($rs2) }}
                    @endif
                </td>
                <td>
                    @if($eventTypeConfig)
                        @foreach ($eventTypeConfig as $key3 => $item3) 
                            @if(isset($item3['user_id']) && $item3['user_id'] ==  $user->id && $item3['event_type'] == 2)
                            <?php  
                                $c++ ;
                                $rs3 .= $c > 1 ? '/ ' : '';
                                $rs3 .= $item3['joined_date'];
                            ?> 
                            @endif
                        @endforeach
                        {{ stringExportCsv($rs3) }}
                    @endif
                </td>
                <td>
                    {{ $user->admin_note }}
                </td>
                {{-- <td>{{ isset($userTypeConfig[$user->user_type]) ? __($userTypeConfig[$user->user_type]) : '' }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    @if (in_array($user->user_type, [0, 1, 3]))
                        {{ $user->corporation_name }}
                    @else 
                        {{ $user->company_name }}
                    @endif
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->payment_created_at }}</td>
                <td>{{ $user->transfer_holder }}</td>
                <td>{{ isset($statusConfig[$user->status]) ? __($statusConfig[$user->status]) : '' }}</td>
                <td>{{ $user->admin_note }}</td> --}}
            </tr>
        @endif
        @php 
            $rememberUserId = $user->id;
        @endphp
    @endforeach
    </tbody>
</table>