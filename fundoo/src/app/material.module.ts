import {NgModule} from "@angular/core";
import { CommonModule } from '@angular/common';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { LayoutModule } from '@angular/cdk/layout';
import {
  MatButtonModule, MatCardModule, MatDialogModule, MatInputModule, MatTableModule,
  MatToolbarModule, MatMenuModule,MatIconModule, MatProgressSpinnerModule,
  MatSelectModule ,MatFormFieldModule
} from '@angular/material';
@NgModule({
  imports: [
  CommonModule, 
  BrowserAnimationsModule,
  LayoutModule,
  MatToolbarModule,
  MatButtonModule, 
  MatCardModule,
  MatInputModule,
  MatDialogModule,
  MatTableModule,
  MatMenuModule,
  MatIconModule,
  MatSelectModule,
  MatProgressSpinnerModule,
  MatFormFieldModule
  ],
  exports: [
  CommonModule,
   MatToolbarModule, 
   MatButtonModule, 
   MatCardModule, 
   MatInputModule, 
   MatDialogModule, 
   MatTableModule, 
   MatMenuModule,
   MatIconModule,
   MatProgressSpinnerModule,
   MatSelectModule,
   MatFormFieldModule
   ],
})
export class CustomMaterial { }