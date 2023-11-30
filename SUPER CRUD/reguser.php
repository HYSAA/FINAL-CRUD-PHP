<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>




</head>

<body>

    <?php
    echo phpinfo();

    ?>


    <div id="data-entry">
        <table id="table-entry">
            <tr>
                <th colspan="2" [ngStyle]="{'text-align': 'center'}">
                    <span>Student Information Data Entry</span>
                </th>
            </tr>
            <tr>
                <!-- student ID -->
                <th><label for="id">Student ID</label></th>
                <td><input [(ngModel)]="studID" type="text" id="id"></td>
            </tr>
            <tr>
                <!-- student first name -->
                <th><label for="fname">First Name</label></th>
                <td><input [(ngModel)]="studFirstName" type="text" id="fname"></td>
            </tr>
            <tr>
                <!-- student middle name -->
                <th><label for="mname">Middle Name</label></th>
                <td><input [(ngModel)]="studMidName" type="text" id="mname"></td>
            </tr>
            <tr>
                <!-- student last name -->
                <th><label for="lname">Last Name</label></th>
                <td><input [(ngModel)]="studLastName" type="text" id="lname"></td>
            </tr>
            <tr>
                <!-- program selection menu -->
                <th><label for="program">Program</label></th>
                <td>
                    <select name="" id="program" [(ngModel)]="selectedProgram">
                        <option [ngValue]="null">---------- Select Program ----------</option>
                        <option *ngFor="let program of programs" [ngValue]="program">
                            {{program.progFullName}}
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <!-- college selection menu -->
                <th><label for="college">College</label></th>
                <td>
                    <select name="" id="college" [(ngModel)]="selectedCollege">
                        <option [ngValue]="null">----------- Select College -----------</option>
                        <option *ngFor="let college of colleges" [ngValue]="college">
                            {{college.colFullName}}
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="year">Year</label></th>
                <td><input [(ngModel)]="studYear" type="text" id="year"></td>
            </tr>
            <tr>
                <td colspan="2" [ngStyle]="{'text-align': 'center'}">
                    <button (click)="saveStudentInfo()" class="button btn-primary">
                        Save
                    </button>

                    <button *ngIf="studentCollection.length > 0" (click)="printStudentEntries()"
                        class="button btn-info">
                        Print
                    </button>

                    <button (click)="clearEntries()" class="button btn-primary">
                        Clear Entries
                    </button>

                    <button *ngIf="studentCollection.length > 0" (click)="destroyCollection()"
                        class="button btn-danger">
                        Clear Dataset
                    </button>




                </td>
            </tr>
        </table>

    </div>

</body>

</html>